<?php

namespace App\Repositories;

use App\Models\Shop\ShopCategory;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\ShopCategoryRepository as ShopCategoryRepositoryContract;
use Illuminate\Support\Collection;

class ShopCategoryRepository extends BaseRepository implements ShopCategoryRepositoryContract
{
    public function __construct(ShopCategory $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return ShopCategory::all();
    }
}
