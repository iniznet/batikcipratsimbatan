<?php

return [

    'resources' => [
        'AutenticationLogResource' => \App\Filament\Resources\Management\AuthenticationLogResource::class,
    ],

    'authenticable-resources' => [
        \App\Models\Management\User::class,
    ],

    'navigation' => [
        'authentication-log' => [
            'sort' => 1,
            'icon' => 'heroicon-o-shield-check',
        ],
    ],

    'sort' => [
        'column' => 'login_at',
        'direction' => 'desc',
    ],

];
