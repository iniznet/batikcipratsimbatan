<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\PostResource\Pages;
use App\Filament\Resources\Blog\PostResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\Blog\PostResource\Widgets\PostOverview;
use App\Models\Blog\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Models\Blog\BlogCategory;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Carbon\Carbon;
use FilamentTiptapEditor\TiptapEditor;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $slug = 'blog/posts';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = -2;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.blog');
    }

    public static function getNavigationBadge(): ?string
    {
        return number_format(Post::count());
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.post');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.posts');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                TitleWithSlugInput::make(
                                    fieldTitle: 'title',
                                    fieldSlug: 'slug',
                                    urlPath: '/blog/',
                                ),

                                TiptapEditor::make('content')
                                    ->label(__('filament-fields.labels.content'))
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
                                    ->options(BlogCategory::pluck('name', 'id'))
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
                                            ->unique(BlogCategory::class, 'slug', ignoreRecord: true),
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
                                    ->label(__('filament-fields.labels.author_id'))
                                    ->relationship('author', 'name')
                                    ->default(fn ($state) => $state ?: auth()->id())
                                    ->required(),
                            ])
                    ])
                    ->columnSpanFull(),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                CuratorPicker::make('featured_image_id')
                                    ->label(__('filament-fields.labels.image'))
                                    ->relationship('featuredImage', 'id'),
                            ])
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('filament-fields.labels.image'))
                    ->getStateUsing(fn (Post $post): string => $post->featuredImage?->path ?? '')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-fields.labels.title'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament-fields.labels.slug'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('filament-fields.labels.author_id'))
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
                    ->getStateUsing(fn (Post $post): string => match ($post->status) {
                        'draft' => __('filament-fields.options.draft'),
                        'publish' => __('filament-fields.options.publish'),
                        'future' => __('filament-fields.options.future'),
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-fields.labels.category'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('filament-fields.labels.published_at'))
                    ->date()
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
            // CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PostOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'activities' => Pages\ListPostActivities::route('/{record}/activities'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
