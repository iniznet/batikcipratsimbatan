<?php

namespace App\Repositories;

use App\Models\Shop\Product;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\ProductRepository as ProductRepositoryContract;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getBySlug(string $slug): Product
    {
        return $this->model
            ->where([
                ['slug', '=', $slug],
                ['status', '=', 'publish']
            ])
            ->firstOrFail();
    }

    public function getRelateds(Product $product, int $limit = 4): Collection
    {
        return $this->model->where('category_id', $product->category->id)
            ->where([
                ['id', '!=', $product->id],
                ['status', '=', 'publish']
            ])
            ->limit($limit)
            ->get();
    }

    public function search(string $query): Collection
    {
        return $this->model
            ->where('status', '=', 'publish')
            ->where('title', 'like', "%{$query}%")
            ->get();
    }
}
