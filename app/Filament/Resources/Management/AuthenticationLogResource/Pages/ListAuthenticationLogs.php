<?php

namespace App\Filament\Resources\Management\AuthenticationLogResource\Pages;

use App\Filament\Resources\Management\AuthenticationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAuthenticationLogs extends ListRecords
{
    protected static string $resource = AuthenticationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
