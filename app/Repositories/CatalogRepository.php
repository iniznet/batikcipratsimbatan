<?php

namespace App\Repositories;

use App\Models\Shop\Product;
use App\Repositories\Concerns\SortType;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\CatalogRepository as CatalogRepositoryContract;
use Illuminate\Pagination\CursorPaginator;

class CatalogRepository extends BaseRepository implements CatalogRepositoryContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getMaxPrice(): int
    {
        return $this->model->max('price');
    }

    public function getSortTypes(): array
    {
        return collect([
            SortType::NEWEST,
            SortType::OLDEST,
            SortType::PRICE_ASC,
            SortType::PRICE_DESC,
        ])->map(fn (SortType $sortType) => [
            'value' => $sortType->value,
            'label' => $sortType->label(),
        ])->toArray();
    }

    public function paginate(int $perPage = 12): CursorPaginator
    {
        return $this->model->cursorPaginate($perPage);
    }

    public function filter(string $title, array $categoryIds, array $materialIds, int $minPrice, int $maxPrice, string $sortType): CursorPaginator
    {
        return $this->model->query()
            ->when($title, fn ($query) => $query->where('title', 'like', "%{query}%"))
            ->when($categoryIds, fn ($query) => $query->whereHas('category', fn ($query) => $query->whereIn('id', $categoryIds)))
            ->when($materialIds, fn ($query) => $query->whereHas('material', fn ($query) => $query->whereIn('id', $materialIds)))
            ->when($minPrice, fn ($query) => $query->where('price', '>=', $minPrice))
            ->when($maxPrice, fn ($query) => $query->where('price', '<=', $maxPrice))
            ->when($sortType, fn ($query) => match ($sortType) {
                SortType::NEWEST->value => $query->orderByDesc('created_at'),
                SortType::OLDEST->value => $query->orderBy('created_at'),
                SortType::PRICE_ASC->value => $query->orderBy('price'),
                SortType::PRICE_DESC->value => $query->orderByDesc('price'),
            })
            ->cursorPaginate(10);
    }
}
