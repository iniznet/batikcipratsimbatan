<?php

namespace App\Filament\Resources\Homepage\PeopleResource\Pages;

use App\Filament\Resources\Homepage\PeopleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeople extends EditRecord
{
    protected static string $resource = PeopleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
