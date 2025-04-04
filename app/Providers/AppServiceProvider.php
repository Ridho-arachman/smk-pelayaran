<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PPDB;
use App\Observers\PPDBObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PPDB::observe(PPDBObserver::class);
        
        view()->composer('partials.footer', function ($view) {
            $view->with('footerCourses', \App\Models\Course::where('is_published', true)->get());
        });
    }
}
