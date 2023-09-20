<?php

namespace App\Filament\Resources\Homepage;

use App\Filament\Resources\Homepage\PeopleResource\Pages;
use App\Filament\Resources\Homepage\PeopleResource\RelationManagers;
use App\Models\Homepage\People;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeopleResource extends Resource
{
    protected static ?string $model = People::class;

    protected static ?string $slug = 'homepage/people';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.homepage');
    }

    public static function getNavigationBadge(): ?string
    {
        return number_format(People::count());
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.people');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.people');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-fields.labels.name'))
                            ->required()
                            ->live(onBlur: true)
                            ->autofocus()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label(__('filament-fields.labels.description'))
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Section::make()
                            ->schema([
                                CuratorPicker::make('image_id')
                                    ->label(__('filament-fields.labels.image'))
                                    ->relationship('image', 'id'),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePeople::route('/create'),
            'edit' => Pages\EditPeople::route('/{record}/edit'),
        ];
    }
}
