<?php

namespace App\Filament\Resources\Settings\UsersResource\Pages;

use App\Filament\Resources\Settings\UsersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;
}
