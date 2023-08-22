<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestComments extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(Comment::query())
            ->columns([
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commentable.type')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Comment')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }
}
