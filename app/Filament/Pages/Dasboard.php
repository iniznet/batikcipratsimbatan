<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Facades\FilamentIcon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static string $routePath = '/';

    protected static ?int $navigationSort = -2;

    /**
     * @var view-string
     */
    protected static string $view = 'filament-panels::pages.dashboard';

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\PageViewsWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\VisitorsWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersOneDayWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersSevenDayWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\ActiveUsersTwentyEightDayWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsDurationWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsByCountryWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\SessionsByDeviceWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\MostVisitedPagesWidget::class,
            \BezhanSalleh\FilamentGoogleAnalytics\Widgets\TopReferrersListWidget::class,
        ];
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int | string | array
    {
        return 2;
    }
}
