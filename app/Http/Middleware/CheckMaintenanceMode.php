<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $isMaintenance = SiteSetting::value('is_maintenance') ?? 0;

        // if ($isMaintenance == 1) {
        //     // Redirect to the 503 page if the site is in maintenance mode
        //     return response()->view('errors.503', [], 503);
        // }

        // // Ensure errors are available for subsequent requests
        // $request->merge(['errors' => session()->get('errors', collect())]);

        return $next($request);
    }
}
