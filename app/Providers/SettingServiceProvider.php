<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            return;
        }

        $settings = DB::table('settings')->get();
        $homepageSettings = DB::table('homepage_settings')->get();

        if ($settings) {
            foreach ($settings as $setting) {
                if ($setting->type === 'repeater') {
                    $value = json_decode($setting->value, true);
                } else {
                    $value = json_decode($setting->value);
                }

                config()->set('settings.' . $setting->key, $value);
            }
        }

        if ($homepageSettings) {
            foreach ($homepageSettings as $setting) {
                if ($setting->type === 'repeater') {
                    $value = json_decode($setting->value, true);
                } else {
                    $value = json_decode($setting->value);
                }

                config()->set('home_settings.' . str_replace('home_', '', $setting->key), $value);
            }
        }
    }
}
