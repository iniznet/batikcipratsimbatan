<?php

namespace App\Filament\Resources\Concerns;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
use RyanChandler\FilamentNavigation\Models\Navigation;

trait SettingSchema
{
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
            'curator' => [
                CuratorPicker::make($name)
                    ->label(__('filament-fields.labels.' . $key)),
            ],
            'curator_multiple' => [
                CuratorPicker::make($name)
                    ->label(__('filament-fields.labels.' . $key))
                    ->multiple(),
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
}
