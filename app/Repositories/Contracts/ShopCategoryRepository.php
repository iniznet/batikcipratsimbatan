<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ShopCategoryRepository
{
    public function all(): Collection;
}
