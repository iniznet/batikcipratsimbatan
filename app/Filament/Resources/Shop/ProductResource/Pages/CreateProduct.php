<?php

namespace App\Filament\Resources\Shop\ProductResource\Pages;

use App\Filament\Resources\Shop\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Collection;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
