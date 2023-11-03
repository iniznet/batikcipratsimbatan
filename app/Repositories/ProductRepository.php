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

    public function getRelated(Product $product): Collection
    {
        return $this->model->where('shop_category_id', $product->shop_category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
    }
}
