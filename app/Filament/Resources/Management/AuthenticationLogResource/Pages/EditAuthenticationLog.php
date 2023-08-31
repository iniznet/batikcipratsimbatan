<?php

namespace App\Filament\Resources\Management\AuthenticationLogResource\Pages;

use App\Filament\Resources\Management\AuthenticationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAuthenticationLog extends EditRecord
{
    protected static string $resource = AuthenticationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
