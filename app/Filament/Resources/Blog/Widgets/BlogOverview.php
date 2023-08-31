<?php

namespace App\Filament\Resources\Blog\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogOverview extends BaseWidget
{
    use InteractsWithPageTable;

    public string $table;

    protected function getTablePage()
    {
        return $this->table ?? null;
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
