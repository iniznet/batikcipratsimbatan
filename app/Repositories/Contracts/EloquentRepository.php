<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EloquentRepository
 * @package App\Repositories\Contracts
 */
interface EloquentRepository
{
    public function getBySlug(string $slug): Model;
}
