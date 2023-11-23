<?php

namespace App\Repositories\Contracts;

use Awcodes\Curator\Models\Media;

interface HomeSettingsRepository
{
    public function get(string $key, mixed $default = null): mixed;

    public function getFeatureds(): array;

    public function getAboutImage(): ?Media;
}
