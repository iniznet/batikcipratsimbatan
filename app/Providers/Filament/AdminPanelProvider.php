<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Management\UserResource;
use Awcodes\Curator\CuratorPlugin;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\LightSwitch\LightSwitchPlugin;
use BezhanSalleh\FilamentLanguageSwitch\FilamentLanguageSwitchPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Pboivin\FilamentPeek\FilamentPeekPlugin;
use pxlrbt\FilamentEnvironmentIndicator\EnvironmentIndicatorPlugin;
use RyanChandler\FilamentNavigation\FilamentNavigation;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
use Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
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

        return $panel
            ->default()
            ->brandName(config('settings.site_title'))
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->plugins([
                FilamentShieldPlugin::make(),
                LightSwitchPlugin::make(),
                EnvironmentIndicatorPlugin::make(),
                QuickCreatePlugin::make()
                    ->excludes([
                        AuthenticationLogResource::class,
                        UserResource::class,
                        RoleResource::class,
                    ]),
                FilamentLanguageSwitchPlugin::make(),
                FilamentPeekPlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make(),
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationSort(0)
                    ->navigationCountBadge(),
                FilamentAuthenticationLogPlugin::make(),
                FilamentNavigation::make(),
            ]);
    }
}
