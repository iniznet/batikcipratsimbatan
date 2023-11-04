<?php

namespace App\View\Composers;

use Illuminate\View\View;
use RyanChandler\FilamentNavigation\Models\Navigation;

class NavigationComposer
{
    public function compose(View $view): void
    {
        $view->with('headerMenu', $this->getHeaderMenu());
        $view->with('footerMenu1', $this->getFooterMenu1());
        $view->with('footerMenu2', $this->getFooterMenu2());
    }

    private function getHeaderMenu(): Navigation
    {
        return Navigation::fromHandle(config('settings.primary_navigation'));
    }

    private function getFooterMenu1(): Navigation
    {
        return Navigation::fromHandle(config('settings.footer_navigation_1'));
    }

    private function getFooterMenu2(): Navigation
    {
        return Navigation::fromHandle(config('settings.footer_navigation_2'));
    }
}
