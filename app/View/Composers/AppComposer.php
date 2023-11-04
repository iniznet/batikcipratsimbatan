<?php

namespace App\View\Composers;

use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view): void
    {
        $view->with('homeSettings', $this->getHomeSettings());
        $view->with('settings', $this->getSettings());

        $view->with('siteLogo', $this->getSiteLogo());
        $view->with('siteTitle', config('settings.site_title'));
        $view->with('siteTitles', $this->getSiteTitles());
    }

    private function getHomeSettings(): array
    {
        $homepageSettings = DB::table('homepage_settings')->get();

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

        return config('home_settings');
    }

    private function getSettings(): array
    {
        $settings = DB::table('settings')->get();

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

        return config('settings');
    }

    private function getSiteLogo(): ?Media
    {
        $siteLogo = config('settings.logo');
        return Media::find($siteLogo);
    }

    private function getSiteTitles(): array
    {
        $siteTitle = config('settings.site_title');
        $siteTitles = explode(' ', $siteTitle);

        if (!is_array($siteTitles)) {
            return [
                0 => '',
                1 => '',
            ];
        }

        $firstRow = array_slice($siteTitles, 0, 2);
        $secondRow = array_slice($siteTitles, 2);

        return [
            0 => implode(' ', $firstRow),
            1 => implode(' ', $secondRow),
        ];

    }
}
