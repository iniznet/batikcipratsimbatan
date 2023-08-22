<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return PostResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('All')),
            'draft' => Tab::make(__('Draft'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft')),
            'publish' => Tab::make(__('Published'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'publish')),
            'future' => Tab::make(__('Scheduled'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'future')),
        ];
    }
}
