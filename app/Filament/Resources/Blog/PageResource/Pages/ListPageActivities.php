<?php

namespace App\Filament\Resources\Blog\PageResource\Pages;

use App\Filament\Resources\Blog\PageResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListPageActivities extends ListActivities
{
    protected static string $resource = PageResource::class;
}
