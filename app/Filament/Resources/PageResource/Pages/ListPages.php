<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
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
