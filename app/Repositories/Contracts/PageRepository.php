<?php

namespace App\Repositories\Contracts;

use App\Models\Blog\Page;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

interface PageRepository
{
    public function getBySlug(string $slug): ?Page;

    public function paginate(int $perPage): CursorPaginator;

    public function search(string $query): Collection;
}
