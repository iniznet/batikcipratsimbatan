<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use App\Filament\Resources\Blog\PostResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListPostActivities extends ListActivities
{
    protected static string $resource = PostResource::class;
}
