<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use App\Filament\Resources\Blog\PostResource;
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
            null => Tab::make(__('filament-general.all')),
            'draft' => Tab::make(__('filament-general.status.draft'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft')),
            'publish' => Tab::make(__('filament-general.status.publish'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'publish')),
            'future' => Tab::make(__('filament-general.status.future'))->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'future')),
        ];
    }
}
