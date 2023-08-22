<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Filament\Resources\PostResource\Pages\ListPosts;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage()
    {
        return ListPosts::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Posts', $this->getPageTableQuery()->count()),
            Stat::make('Published Posts', $this->getPageTableQuery()->where('status', 'publish')->count()),
            Stat::make('Scheduled Posts', $this->getPageTableQuery()->where('status', 'future')->count()),
        ];
    }
}
