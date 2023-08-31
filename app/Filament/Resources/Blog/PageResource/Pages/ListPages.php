<?php

namespace App\Filament\Resources\Blog\PageResource\Pages;

use App\Filament\Resources\Blog\PageResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPages extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return PageResource::getWidgets();
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
