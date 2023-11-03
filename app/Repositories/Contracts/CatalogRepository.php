<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\CursorPaginator;

interface CatalogRepository
{
    public function getMaxPrice(): int;

    public function getSortTypes(): array;

    public function paginate(int $perPage = 12): CursorPaginator;

    public function filter(string $title, array $categoryIds, array $materialIds, int $minPrice, int $maxPrice, string $sortType): CursorPaginator;
}
