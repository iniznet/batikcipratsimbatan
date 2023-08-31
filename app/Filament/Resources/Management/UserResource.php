<?php

namespace App\Filament\Resources\Management;

use App\Filament\Resources\Management\UserResource\Pages;
use App\Filament\Resources\Management\UserResource\RelationManagers;
use App\Models\Management\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Tapp\FilamentAuthenticationLog\RelationManagers\AuthenticationLogsRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = -2;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.management');
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.user');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament-fields.labels.name'))
                    ->required()
                    ->autofocus()
                    ->maxLength(255),

                Forms\Components\TextInput::make('username')
                    ->label(__('filament-fields.labels.username'))
                    ->required()
                    ->maxLength(50),

                Forms\Components\TextInput::make('email')
                    ->label(__('filament-fields.labels.email'))
                    ->required()
                    ->maxLength(255)
                    ->email(),

                Forms\Components\TextInput::make('password')
                    ->label(__('filament-fields.labels.password'))
                    ->required(fn (string $operation) => $operation === 'create')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null),

                Forms\Components\TextInput::make('phone')
                    ->label(__('filament-fields.labels.phone'))
                    ->numeric()
                    ->maxLength(13),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label(__('filament-fields.labels.email_verified_at')),

                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->preload()
                    ->relationship('roles', 'name')
                    ->label(__('filament-fields.labels.roles')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('filament-fields.labels.id'))
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-fields.labels.name'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('username')
                    ->label(__('filament-fields.labels.username'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament-fields.labels.email'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('filament-fields.labels.phone'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label(__('filament-fields.labels.email_verified_at'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-fields.labels.created_at'))
                    ->searchable()
                    ->sortable()
                    ->dateTime('F j, Y')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-fields.labels.updated_at'))
                    ->searchable()
                    ->sortable()
                    ->dateTime('F j, Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(__('filament-fields.labels.verified'))
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(__('filament-fields.labels.unverified'))
                    ->query(fn(Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AuthenticationLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
