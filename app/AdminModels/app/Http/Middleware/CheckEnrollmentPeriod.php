<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckEnrollmentPeriod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $settings = SiteSetting::first(); // Assuming there's only one row

        if (!$settings || !$settings->start_enrollment || !$settings->end_enrollment) {
            return response()->view('errors.enrollment-not-active', [
                'message' => $settings->enrollment_announcement ?? 'Enrollment period settings not found.'
            ], 500);
        }

        $now = Carbon::now();

        if ($now->lt($settings->start_enrollment) || $now->gt($settings->end_enrollment)) {
            return response()->view('errors.enrollment-not-active', [
                'message' => $settings->enrollment_announcement ?? 'Access denied. Enrollment period is not active.'
            ], 500);
        }

        return $next($request);
    }
}
