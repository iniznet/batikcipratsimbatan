<?php

namespace App\Filament\Resources\Homepage;

use App\Filament\Resources\Homepage\CarouselResource\Pages;
use App\Filament\Resources\Homepage\CarouselResource\RelationManagers;
use App\Models\Homepage\Carousel;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarouselResource extends Resource
{
    protected static ?string $model = Carousel::class;

    protected static ?string $slug = 'homepage/carousel';

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?int $navigationSort = -2;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.homepage');
    }

    public static function getNavigationBadge(): ?string
    {
        return number_format(Carousel::count());
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.carousel');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.carousel');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        CuratorPicker::make('image_id')
                            ->label(__('filament-fields.labels.image'))
                            ->relationship('attachedImage', 'id'),
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
            'index' => Pages\ListCarousels::route('/'),
            'create' => Pages\CreateCarousel::route('/create'),
            'edit' => Pages\EditCarousel::route('/{record}/edit'),
        ];
    }
}
