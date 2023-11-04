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
            \App\Repositories\Contracts\HomeSettingsRepository::class,
            \App\Repositories\HomeSettingsRepository::class
        );

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

        $this->app->bind(
            \App\Repositories\Contracts\PostRepository::class,
            \App\Repositories\PostRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\PageRepository::class,
            \App\Repositories\PageRepository::class
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
