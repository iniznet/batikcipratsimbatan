<?php

namespace App\Repositories\Contracts;

use App\Models\Shop\Product;
use Illuminate\Support\Collection;

interface ProductRepository
{
    public function getBySlug(string $slug): Product;

    public function getRelateds(Product $product): Collection;

    public function search(string $query): Collection;
}
