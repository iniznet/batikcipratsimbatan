<?php

namespace App\Filament\Resources\Homepage\PeopleResource\Pages;

use App\Filament\Resources\Homepage\PeopleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePeople extends CreateRecord
{
    protected static string $resource = PeopleResource::class;
}
