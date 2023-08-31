<?php

namespace App\Filament\Resources\Shop\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('content')
                    ->label(__('filament-fields.labels.content'))
                    ->required(),

                Forms\Components\TextInput::make('author')
                    ->label(__('filament-fields.labels.author'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_visible')
                    ->label(__('filament-fields.labels.is_visible'))
                    ->default(true),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('content')
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->label(__('filament-fields.labels.content'))
                    ->limit(50),

                Tables\Columns\TextColumn::make('author')
                    ->label(__('filament-fields.labels.author'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label(__('filament-fields.labels.is_visible'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
