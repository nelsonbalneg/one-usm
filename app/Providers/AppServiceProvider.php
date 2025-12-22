<?php

namespace App\Providers;

use App\Models\Result;
use App\Models\SiteSetting;
use Laravel\Telescope\Telescope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // Exclude the 'submit' route from CSRF protection
        VerifyCsrfToken::except([
            'submit'
        ]);

        View::composer('admin.layouts.sidebar', function ($view) {

            $pendingEditCount = DB::table('results')
                ->join('cee_sessions', 'results.cee_session_id', '=', 'cee_sessions.id')
                ->where('results.ispending_edit', 'yes')
                // ->where('cee_sessions.status', 'active')
                ->count();

            $view->with('pendingEditCount', $pendingEditCount);
        });

        View::composer('admin.layouts.footer', function ($view) {
            $footertext = SiteSetting::first();
            $view->with('footertext', $footertext);
        });

    }
}
