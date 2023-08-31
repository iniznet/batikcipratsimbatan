<?php

namespace App\Filament\Resources\Shop\ProductResource\Pages;

use App\Filament\Resources\Shop\ProductResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return ProductResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('filament-general.all')),
            'draft' => Tab::make(__('filament-general.status.draft'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft')),
            'publish' => Tab::make(__('filament-general.status.publish'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'publish')),
            'future' => Tab::make(__('filament-general.status.future'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'future')),
        ];
    }
}
