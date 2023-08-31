<?php

namespace App\Filament\Resources\Management\UserResource\Pages;

use App\Filament\Resources\Management\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
