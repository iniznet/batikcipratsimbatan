<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\CommentsRelationManager;
use App\Models\Product;
use App\Models\ShopCategory;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->autofocus()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        MarkdownEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('category_id')
                            ->label(__('Category'))
                            ->relationship('category', 'name')
                            ->options(ShopCategory::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->lazy()
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        $set('slug', Str::slug($state));
                                        $set('name', ucfirst($state));
                                    })
                                    ->required(),
                                Hidden::make('slug')
                                    ->required()
                                    ->unique(ShopCategory::class, 'slug', ignoreRecord: true),
                            ]),


                        DateTimePicker::make('published_at')
                            ->default(fn ($state) => $state ?: now()),

                        Select::make('status')
                            ->options([
                                'draft' => __('Draft'),
                                'publish' => __('Published'),
                                'future' => __('Scheduled'),
                            ])
                            ->default('draft')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $state === 'publish' ? $set('published_at', now()) : $state),

                        Hidden::make('slug')
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        Select::make('author_id')
                            ->relationship('author', 'name')
                            ->default(fn ($state) => $state ?: auth()->id())
                            ->required(),
                    ])
                    ->collapsible(),

                Section::make(__('Details'))
                    ->schema([
                        Repeater::make('colors')
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Color'))
                                    ->required(),
                                TextInput::make('extra_price')
                                    ->label(__('Extra Price'))
                                    ->placeholder(__('Leave blank if there is no extra price'))
                                    ->numeric(),
                            ])
                            ->orderColumn('name')
                            ->defaultItems(1)
                            ->hiddenLabel()
                            ->columns(2),

                        Repeater::make('sizes')
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Size'))
                                    ->required(),
                                TextInput::make('extra_price')
                                    ->label(__('Extra Price'))
                                    ->placeholder(__('Leave blank if there is no extra price'))
                                    ->numeric(),
                            ])
                            ->orderColumn('name')
                            ->defaultItems(1)
                            ->hiddenLabel()
                            ->columns(2),
                    ])
                    ->collapsible(),

                Section::make(__('Images'))
                    ->schema([
                        FileUpload::make('images')
                            ->hiddenLabel()
                            ->image()
                            ->multiple(),
                    ])
                    ->collapsible(),

                Section::make(__('Pricing'))
                    ->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->required(),
                    ]),

                Section::make(__('Platform'))
                    ->schema([
                        Repeater::make('platforms')
                            ->schema([
                                Select::make('name')
                                    ->label(__('Platform'))
                                    ->options([
                                        'tokopedia' => __('Tokopedia'),
                                        'shopee' => __('Shopee'),
                                        'bukalapak' => __('Bukalapak'),
                                        'lazada' => __('Lazada'),
                                        'blibli' => __('Blibli'),
                                        'whatsapp' => __('WhatsApp'),
                                        'instagram' => __('Instagram'),
                                        'facebook' => __('Facebook'),
                                        'tiktok' => __('TikTok'),
                                    ])
                                    ->required(),
                                TextInput::make('value')
                                    ->label(__('Link'))
                                    ->required(),
                            ])
                            ->orderColumn('name')
                            ->defaultItems(1)
                            ->hiddenLabel()
                            ->columns(2)
                            ->required(),
                    ])
                    ->collapsible(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(fn (Product $product) => $product->getFirstMediaUrl()),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('Author'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('Published'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('featured')
                    ->label(__('Featured'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
