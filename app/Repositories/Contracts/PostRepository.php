<?php

namespace App\Repositories\Contracts;

use App\Models\Blog\Post;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

interface PostRepository
{
    public function get(int $limit = 3): ?Collection;

    public function getLatest(): ?Post;

    public function getBySlug(string $slug): ?Post;

    public function getRelateds(Post $post, int $limit = 4): CursorPaginator;

    public function paginate(int $perPage = 4, bool $excludeLatest = true): CursorPaginator;

    public function search(string $query): Collection;
}
