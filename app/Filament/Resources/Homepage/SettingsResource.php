<?php

namespace App\Filament\Resources\Homepage;

use App\Filament\Resources\Concerns\SettingSchema;
use App\Filament\Resources\Homepage\SettingsResource\Pages;
use App\Models\Homepage\Settings;
use Awcodes\Curator\Models\Media;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class SettingsResource extends Resource
{
    use SettingSchema;

    protected static ?string $model = Settings::class;

    protected static ?string $slug = 'homepage/settings';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?int $navigationSort = -2;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-navigation.groups.homepage');
    }

    public static function getLabel(): string
    {
        return __('filament-navigation.labels.homepage-settings');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-navigation.labels.homepage-settings');
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

                        if ($record->type === 'curator') {
                            $value = Media::find($value)?->name ?: __('filament-general.empty');
                        }

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

    public static function arrayToString(array|string|null $array): string
    {
        if (!is_array($array)) {
            return $array ?: __('filament-general.empty');
        }

        $array = is_array($array[0]) ? $array[0] : $array;

        return count($array) . ' ' . __('filament-general.saved');
    }
}
