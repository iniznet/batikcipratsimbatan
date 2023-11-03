<?php

namespace App\Filament\Resources\Blog;

use App\Filament\Resources\Blog\PageResource\Pages;
use App\Filament\Resources\Blog\PageResource\Widgets\PageOverview;
use App\Models\Blog\Page;
use App\Models\Blog\Post;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $slug = 'blog/pages';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 0;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.blog');
    }

    public static function getNavigationBadge(): ?string
    {
        return number_format(Page::count());
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.page');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.pages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label(__('filament-fields.labels.title'))
                                    ->required()
                                    ->live(onBlur: true)
                                    ->autofocus()
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                                    ->maxLength(255),

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

                                Forms\Components\Hidden::make('slug')
                                    ->required()
                                    ->unique(Page::class, 'slug', ignoreRecord: true),

                                Forms\Components\Select::make('author_id')
                                    ->label(__('filament-fields.labels.author'))
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
                    ->getStateUsing(fn (Post $post): ?string => $post->featuredImage?->path)
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
                    ->label(__('filament-fields.labels.author'))
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
                    ->getStateUsing(fn (Page $page): string => match ($page->status) {
                        'draft' => __('filament-fields.options.draft'),
                        'publish' => __('filament-fields.options.publish'),
                        'future' => __('filament-fields.options.future'),
                    })
                    ->toggleable(),

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
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PageOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'activities' => Pages\ListPageActivities::route('/{record}/activities'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
