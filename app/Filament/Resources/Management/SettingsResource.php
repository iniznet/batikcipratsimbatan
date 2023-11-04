<?php

namespace App\Filament\Resources\Management;

use App\Filament\Resources\Management\SettingsResource\Pages;
use App\Filament\Resources\Management\SettingsResource\RelationManagers;
use App\Models\Management\Settings;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RyanChandler\FilamentNavigation\Models\Navigation;

class SettingsResource extends Resource
{
    protected static ?string $model = Settings::class;

    protected static ?string $slug = 'settings';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?int $navigationSort = 100;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.management');
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.settings');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.settings');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        /**
         * Logo, Site Title, Tagline, Description, WhatsApps number repeater
         */
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label(__('filament-fields.labels.label'))
                    ->formatStateUsing(fn (Settings $record) => __('filament-fields.labels.' . $record->key))
                    ->searchable(),

                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament-fields.labels.value'))
                    ->getStateUsing(function (Settings $record) {
                        $value = self::arrayToString($record->value);

                        if (strlen($value) > 80) {
                            $value = substr($value, 0, 80) . '...';
                        }

                        return $value;
                    })
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form(fn (Settings $record) => self::schema($record->key, $record->type, $record->attributes ?? [])),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }

    public static function schema(string $key, string $type, array $attributes = []): array
    {
        $name = $attributes['name'] ?? 'value';

        return match ($type) {
            'repeater' => [
                TableRepeater::make($name)
                    ->label(__('filament-fields.labels.' . $key))
                    ->schema(function () use ($attributes) {
                        $schemas = [];
                        $columns = $attributes['columns'];

                        foreach ($columns as $column) {
                            $schemas[] = self::schema($column['key'], $column['type'], [
                                'name' => $column['key'] ?? null,
                            ]);
                        }

                        $schemas = array_merge(...$schemas);

                        return $schemas;
                    }),
            ],
            'image' => [
                Forms\Components\FileUpload::make($name)
                    ->label(__('filament-fields.labels.' . $key)),
            ],
            'menu' => [
                Forms\Components\Select::make($name)
                    ->label(__('filament-fields.labels.' . $key))
                    ->options(function () {
                        $menus = Navigation::all();

                        return $menus->mapWithKeys(function ($menu) {
                            return [$menu->handle => $menu->name];
                        });
                    }),
            ],
            'textarea' => [
                Forms\Components\Textarea::make($name)
                    ->label(__('filament-fields.labels.' . $key)),
            ],
            'number' => [
                Forms\Components\TextInput::make($name)
                    ->label(__('filament-fields.labels.' . $key))
                    ->numeric(),
            ],
            'phone' => [
                Forms\Components\TextInput::make($name)
                    ->label(__('filament-fields.labels.' . $key))
                    ->numeric()
                    // replace first 0 with 62 if it exists
                    ->dehydrateStateUsing(fn (string $state) => preg_replace('/^0/', '62', $state))
            ],
            default => [
                Forms\Components\TextInput::make($name)
                    ->label(__('filament-fields.labels.' . $key)),
            ],
        };
    }

    public static function arrayToString(array|string|null $array): string
    {
        if (!is_array($array)) {
            return $array ?: __('filament-general.empty');
        }

        $array = $array[0];

        return count($array) . ' ' . __('filament-general.phone_numbers');
    }
}
