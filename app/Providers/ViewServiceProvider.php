<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('*', AppComposer::class);
        Facades\View::composer('layouts.app', NavigationComposer::class);
    }
}
