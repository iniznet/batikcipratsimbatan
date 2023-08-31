<?php

namespace App\Filament\Resources\Blog\PostResource\Widgets;

use App\Models\Blog\Post;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getStats(): array
    {
        return [
            Stat::make(__('filament-general.total'), Post::count()),
            Stat::make(__('filament-general.status.publish'), Post::where('status', 'publish')->count()),
            Stat::make(__('filament-general.status.future'), Post::where('status', 'future')->count()),
        ];
    }
}
