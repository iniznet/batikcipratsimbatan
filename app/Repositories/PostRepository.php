<?php

namespace App\Repositories;

use App\Models\Blog\Post;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\PostRepository as PostRepositoryContract;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository implements PostRepositoryContract
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function get(int $limit = 2, bool $excludeLatest = true): ?Collection
    {
        if ($excludeLatest) {
            return $this->model
                ->where('status', '=', 'publish')
                ->where('id', '<>', $this->model->latest()->first()->id)
                ->limit($limit)
                ->get();
        }

        return $this->model
            ->where('status', '=', 'publish')
            ->limit($limit)
            ->get();
    }

    public function getLatest(): ?Post
    {
        return $this->model
            ->where('status', '=', 'publish')
            ->latest()
            ->first();
    }

    public function getBySlug(string $slug): ?Post
    {
        return $this->model
            ->where([
                ['slug', '=', $slug],
                ['status', '=', 'publish']
            ])
            ->firstOrFail();
    }

    public function getRelateds(Post $post, int $limit = 4): CursorPaginator
    {
        $categoryId = $post?->category_id;

        return $this->model
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', '=', $categoryId);
            })
            ->where([
                ['status', '=', 'publish'],
                ['id', '<>', $post->id]
            ])
            ->cursorPaginate($limit);
    }

    public function paginate(int $perPage = 4, bool $excludeLatest = true): CursorPaginator
    {
        if ($excludeLatest) {
            return $this->model
                ->where('status', '=', 'publish')
                ->where('id', '<>', $this->model->latest()->first()->id)
                ->cursorPaginate($perPage);
        }

        return $this->model
            ->where('status', '=', 'publish')
            ->cursorPaginate($perPage);
    }
}
