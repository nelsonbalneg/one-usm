<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class DetectWebView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');

        // Detect Facebook or Instagram in-app browser
        if (strpos($userAgent, 'FBAN') !== false || strpos($userAgent, 'FBAV') !== false || strpos($userAgent, 'Instagram') !== false) {
            // Redirect to an instruction page
            return redirect()->route('webview.instruction');
        }

        return $next($request);
    }
}
