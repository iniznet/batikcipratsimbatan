<?php

namespace App\Repositories\Contracts;

use App\Models\Shop\Product;
use Illuminate\Support\Collection;

interface ShopMaterialRepository
{
    public function all(): Collection;
}
