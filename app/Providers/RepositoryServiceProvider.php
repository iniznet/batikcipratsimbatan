<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\ShopCategoryRepository::class,
            \App\Repositories\ShopCategoryRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ShopMaterialRepository::class,
            \App\Repositories\ShopMaterialRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ProductRepository::class,
            \App\Repositories\ProductRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\CatalogRepository::class,
            \App\Repositories\CatalogRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
