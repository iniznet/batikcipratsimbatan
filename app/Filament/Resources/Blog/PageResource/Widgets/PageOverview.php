<?php

namespace App\Filament\Resources\Blog\PageResource\Widgets;

use App\Models\Blog\Page;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PageOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getStats(): array
    {
        return [
            Stat::make(__('filament-general.total'), Page::count()),
            Stat::make(__('filament-general.status.publish'), Page::where('status', 'publish')->count()),
            Stat::make(__('filament-general.status.future'), Page::where('status', 'future')->count()),
        ];
    }
}
