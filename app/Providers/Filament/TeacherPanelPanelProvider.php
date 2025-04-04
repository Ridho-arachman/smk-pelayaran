<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Http\Middleware\TeacherAccess;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

// Widget Imports
use App\Filament\TeacherPanel\Widgets\{
    StatsOverview,
    LatestCourses,
    RecentMaterials,
    UnpublishedLessons,
};

class TeacherPanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('teacherPanel')
            ->path('teacher')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/TeacherPanel/Resources'), for: 'App\\Filament\\TeacherPanel\\Resources')
            ->discoverPages(in: app_path('Filament/TeacherPanel/Pages'), for: 'App\\Filament\\TeacherPanel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/TeacherPanel/Widgets'), for: 'App\\Filament\\TeacherPanel\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                StatsOverview::class,
                LatestCourses::class,
                RecentMaterials::class,
                UnpublishedLessons::class,
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
            ->authGuard('web')
            ->authMiddleware([
                Authenticate::class,
                TeacherAccess::class,
            ])
            ->login()
            ->registration(false)
            ->passwordReset(false);
    }
}
