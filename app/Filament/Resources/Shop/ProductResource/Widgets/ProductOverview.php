<?php

namespace App\Filament\Resources\Shop\ProductResource\Widgets;

use App\Filament\Resources\Shop\ProductResource\Pages\ListProducts;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage()
    {
        return ListProducts::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('filament-general.total'), $this->getPageTableQuery()->get()->count()),
            Stat::make(__('filament-general.status.publish'), $this->getPageTableQuery()->where('status', 'publish')->count()),
            Stat::make(__('filament-general.status.future'), $this->getPageTableQuery()->where('status', 'future')->count()),
        ];
    }
}
