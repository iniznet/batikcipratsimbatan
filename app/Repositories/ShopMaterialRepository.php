<?php

namespace App\Repositories;

use App\Models\Shop\ShopMaterial;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\ShopMaterialRepository as ShopMaterialRepositoryContract;
use Illuminate\Support\Collection;

class ShopMaterialRepository extends BaseRepository implements ShopMaterialRepositoryContract
{
    public function __construct(ShopMaterial $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
