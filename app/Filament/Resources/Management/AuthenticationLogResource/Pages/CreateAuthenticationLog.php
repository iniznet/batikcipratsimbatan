<?php

namespace App\Filament\Resources\Management\AuthenticationLogResource\Pages;

use App\Filament\Resources\Management\AuthenticationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAuthenticationLog extends CreateRecord
{
    protected static string $resource = AuthenticationLogResource::class;
}
