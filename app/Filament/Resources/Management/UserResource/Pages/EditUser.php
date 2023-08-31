<?php

namespace App\Filament\Resources\Management\UserResource\Pages;

use App\Filament\Resources\Management\UserResource;
use App\Models\Management\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function mutateFormDataBeforeSave(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !empty($data['password'])) {
            return $data;
        }

        $data['password'] = $user->password;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
