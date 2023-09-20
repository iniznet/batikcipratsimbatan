<?php

namespace App\Filament\Resources\Homepage\CarouselResource\Pages;

use App\Filament\Resources\Homepage\CarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarousel extends EditRecord
{
    protected static string $resource = CarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
