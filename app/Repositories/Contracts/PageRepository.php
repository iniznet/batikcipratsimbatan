<?php

namespace App\Repositories\Contracts;

use App\Models\Blog\Page;
use Illuminate\Pagination\CursorPaginator;

interface PageRepository
{
    public function getBySlug(string $slug): ?Page;

    public function paginate(int $perPage): CursorPaginator;
}
