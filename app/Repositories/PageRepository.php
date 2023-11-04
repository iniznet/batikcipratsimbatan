<?php

namespace App\Repositories;

use App\Models\Blog\Page;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\PageRepository as PageRepositoryContract;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;

class PageRepository extends BaseRepository implements PageRepositoryContract
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function getBySlug(string $slug): Page
    {
        return $this->model
            ->where([
                ['slug', '=', $slug],
                ['status', '=', 'publish']
            ])
            ->firstOrFail();
    }

    public function paginate(int $perPage = 4): CursorPaginator
    {
        return $this->model
            ->where('status', '=', 'publish')
            ->cursorPaginate($perPage);
    }

    public function search(string $query): Collection
    {
        return $this->model
            ->where('status', '=', 'publish')
            ->where('title', 'like', "%{$query}%")
            ->get();
    }
}
