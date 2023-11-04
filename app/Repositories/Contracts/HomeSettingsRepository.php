<?php

namespace App\Repositories\Contracts;

interface HomeSettingsRepository
{
    public function get(string $key, mixed $default = null): mixed;

    public function getFeatureds(): array;
}
