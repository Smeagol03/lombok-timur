<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\AgendaHariIniWidget;
use App\Filament\Widgets\BeritaPopulerWidget;
use App\Filament\Widgets\BeritaStatsWidget;
use App\Filament\Widgets\KontenOverviewWidget;
use App\Filament\Widgets\StokDarahWidget;
use App\Models\Setting;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $setting = null;
        try {
            $setting = Setting::first();
        } catch (\Exception $e) {
            // Table might not exist yet (during migration)
        }

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->passwordReset()
            ->brandName($setting?->site_name ?? 'Portal Lombok Timur')
            ->brandLogo(fn () => view('filament.admin.logo', ['setting' => $setting]))
            ->brandLogoHeight('2.5rem')
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('15rem')
            ->collapsedSidebarWidth('4rem')
            ->navigationGroups([
                NavigationGroup::make('Konten')
                    ->icon('heroicon-o-document-text')
                    ->collapsed(),
                NavigationGroup::make('Layanan Publik')
                    ->icon('heroicon-o-building-library')
                    ->collapsed(),
                NavigationGroup::make('Data')
                    ->icon('heroicon-o-chart-bar')
                    ->collapsed(),
                NavigationGroup::make('Media')
                    ->icon('heroicon-o-photo')
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                KontenOverviewWidget::class,
                BeritaStatsWidget::class,
                StokDarahWidget::class,
                AgendaHariIniWidget::class,
                BeritaPopulerWidget::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
