<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\ProductResource\Pages;
use App\Filament\Resources\Shop\ProductResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\Shop\ProductResource\Widgets\ProductOverview;
use App\Models\Shop\Product;
use App\Models\Shop\ShopCategory;
use App\Models\Shop\ShopMaterial;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Support\RawJs;
use FilamentTiptapEditor\TiptapEditor;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?int $navigationSort = -3;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.shop');
    }

    public static function getNavigationBadge(): ?string
    {
        return number_format(Product::count());
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.product');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.products');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        TitleWithSlugInput::make(fieldTitle: 'title', fieldSlug: 'slug'),

                        TiptapEditor::make('content')
                            ->label(__('filament-fields.labels.content'))
                            ->required()
                            ->columnSpanFull()
                            ->profile('custom')
                            ->tools([
                                'heading','hr', 'bullet-list', 'ordered-list', 'checked-list', '|',
                                'bold', 'italic', 'lead', 'small', '|',
                                'link', 'media', 'table', '|'
                            ]),

                        Forms\Components\Select::make('category_id')
                            ->label(__('filament-fields.labels.category'))
                            ->relationship('category', 'name')
                            ->options(ShopCategory::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('filament-fields.labels.name'))
                                    ->lazy()
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        $set('slug', Str::slug($state));
                                        $set('name', ucfirst($state));
                                    })
                                    ->required(),
                                Forms\Components\Hidden::make('slug')
                                    ->required()
                                    ->unique(ShopCategory::class, 'slug', ignoreRecord: true),
                            ]),

                        Forms\Components\Select::make('material_id')
                            ->label(__('filament-fields.labels.material'))
                            ->relationship('material', 'name')
                            ->options(ShopMaterial::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('filament-fields.labels.name'))
                                    ->lazy()
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        $set('slug', Str::slug($state));
                                        $set('name', ucfirst($state));
                                    })
                                    ->required(),
                                Forms\Components\Hidden::make('slug')
                                    ->required()
                                    ->unique(ShopMaterial::class, 'slug', ignoreRecord: true),
                            ]),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label(__('filament-fields.labels.published_at'))
                            ->default(fn ($state) => $state ?: now()),

                        Forms\Components\Select::make('status')
                            ->label(__('filament-fields.labels.status'))
                            ->options([
                                'draft' => __('filament-fields.options.draft'),
                                'publish' => __('filament-fields.options.publish'),
                                'future' => __('filament-fields.options.future'),
                            ])
                            ->default('draft')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $state === 'publish' ? $set('published_at', now()) : $state),

                        Forms\Components\Select::make('author_id')
                            ->label(__('filament-fields.labels.author'))
                            ->relationship('author', 'name')
                            ->default(fn ($state) => $state ?: auth()->id())
                            ->required(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make(__('filament-fields.labels.images'))
                    ->schema([
                        CuratorPicker::make('product_picture_ids')
                            ->hiddenLabel()
                            ->multiple()
                            ->relationship('productPictures', 'id')
                            ->orderColumn('order'),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make(__('filament-fields.labels.pricing'))
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label(__('filament-fields.labels.price'))
                            ->required()
                            ->prefix('Rp')
                            ->mask(RawJs::make(<<<'JS'
                                $money($input, ',', '.')
                            JS))
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                            ->dehydrateStateUsing(fn ($state) => str_replace(['.', ','], '', $state)),

                        // Forms\Components\Section::make(__('filament-fields.labels.variants'))
                        // ->schema([
                        //     TableRepeater::make('colors')
                        //         ->schema([
                        //             Forms\Components\TextInput::make('name')
                        //                 ->label(__('filament-fields.labels.color'))
                        //                 ->required(),
                        //             Forms\Components\TextInput::make('extra_price')
                        //                 ->label(__('filament-fields.labels.extra_price'))
                        //                 ->placeholder(__('filament-fields.placeholders.extra_price'))
                        //                 ->prefix('Rp')
                        //                 ->mask(RawJs::make(<<<'JS'
                        //                     $money($input, ',', '.')
                        //                 JS))
                        //                 ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                        //                 ->dehydrateStateUsing(fn ($state) => str_replace(['.', ','], '', $state)),
                        //         ])
                        //         ->addActionLabel(__('filament-fields.actions.add_color'))
                        //         ->orderColumn('name')
                        //         ->defaultItems(1)
                        //         ->hiddenLabel()
                        //         ->columns(2),

                        //     TableRepeater::make('sizes')
                        //         ->schema([
                        //             Forms\Components\TextInput::make('name')
                        //                 ->label(__('filament-fields.labels.size'))
                        //                 ->required(),
                        //             Forms\Components\TextInput::make('extra_price')
                        //                 ->label(__('filament-fields.labels.extra_price'))
                        //                 ->placeholder(__('filament-fields.placeholders.extra_price'))
                        //                 ->prefix('Rp')
                        //                 ->mask(RawJs::make(<<<'JS'
                        //                     $money($input, ',', '.')
                        //                 JS))
                        //                 ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                        //                 ->dehydrateStateUsing(fn ($state) => str_replace(['Rp', '.', ','], '', $state)),
                        //         ])
                        //         ->addActionLabel(__('filament-fields.actions.add_size'))
                        //         ->orderColumn('name')
                        //         ->defaultItems(1)
                        //         ->hiddenLabel()
                        //         ->columns(2),
                        // ])
                        // ->collapsible(),
                    ])
                    ->collapsible(),

                // Forms\Components\Section::make(__('filament-fields.labels.platforms'))
                //     ->schema([
                //             TableRepeater::make('platforms')
                //                 ->schema([
                //                     Forms\Components\Select::make('name')
                //                         ->label(__('filament-fields.labels.platform'))
                //                         ->options([
                //                             'tokopedia' => __('Tokopedia'),
                //                             'shopee' => __('Shopee'),
                //                             'bukalapak' => __('Bukalapak'),
                //                             'lazada' => __('Lazada'),
                //                             'blibli' => __('Blibli'),
                //                             'whatsapp' => __('WhatsApp'),
                //                             'instagram' => __('Instagram'),
                //                             'facebook' => __('Facebook'),
                //                             'tiktok' => __('TikTok'),
                //                         ])
                //                         ->required(),
                //                     Forms\Components\TextInput::make('value')
                //                         ->label(__('filament-fields.labels.link'))
                //                         ->required(),
                //                 ])
                //                 ->addActionLabel(__('filament-fields.actions.add_platform'))
                //                 ->orderColumn('name')
                //                 ->defaultItems(1)
                //                 ->hiddenLabel()
                //                 ->columns(2)
                //                 ->required(),
                //     ])
                //     ->collapsible(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('filament-fields.labels.image'))
                    ->getStateUsing(fn (Product $product) => $product->productPictures->first()?->path)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-fields.labels.title'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-fields.labels.category'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('material.name')
                    ->label(__('filament-fields.labels.material'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('filament-fields.labels.author'))
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('filament-fields.labels.published_at'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-fields.labels.status'))
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'draft' => 'gray',
                        'publish' => 'green',
                        'future' => 'blue',
                        default => 'gray',
                    })
                    ->getStateUsing(fn (Product $product): string => match ($product->status) {
                        'draft' => __('filament-fields.options.draft'),
                        'publish' => __('filament-fields.options.publish'),
                        'future' => __('filament-fields.options.future'),
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament-fields.labels.price'))
                    ->formatStateUsing(fn ($state) => __('Rp') . number_format($state, 0, ',', '.'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('featured')
                    ->label(__('filament-fields.labels.featured'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->label(__('filament-fields.labels.published_from'))
                            ->placeholder(fn ($state): string => now()->subYear()->format('F j, Y')),
                        Forms\Components\DatePicker::make('published_until')
                            ->label(__('filament-fields.labels.published_until'))
                            ->placeholder(fn ($state): string => now()->format('F j, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['published_from'] ?? null) {
                            $indicators['published_from'] = 'Published from ' . Carbon::parse($data['published_from'])->toFormattedDateString();
                        }
                        if ($data['published_until'] ?? null) {
                            $indicators['published_until'] = 'Published until ' . Carbon::parse($data['published_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
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
                ExportBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ProductOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'activities' => Pages\ListProductActivities::route('/{record}/activities'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
