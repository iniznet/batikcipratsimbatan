<?php

namespace App\Filament\Resources\Blog\PageResource\Pages;

use App\Filament\Resources\Blog\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
