<?php

namespace App\Providers;

use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\URL;
use App\Models\ChedApplicantProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::composer('student.layouts.sidebar', function ($view) {
            // $ched_applicant_Profile = ChedApplicantProfile::where('user_id', Auth::id())
            //     ->where('status', 1)
            //     ->first();

            // $result_confirmation_batch = Result::where('user_id', Auth::id())
            //     ->where('status', 'posted')
            //     // ->where('confirmation_batch', 1)
            //     ->first();

            //fetch the Sitesettings
            // $site_settings = DB::table('site_settings')->first();

            $view->with([
                // 'ched_applicant_Profile' => $ched_applicant_Profile,
                // 'result_confirmation_batch' => $result_confirmation_batch,
                // 'site_settings' => $site_settings,
            ]);
        });
    }
}
