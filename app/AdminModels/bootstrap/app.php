<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\UpdateLastSeen;
use App\Http\Middleware\CheckEnrollmentPeriod;
use App\Http\Middleware\ExcludeApiRoutesFromCsrf;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {

            Route::middleware(['web', 'auth', 'role:admin', 'update.last.seen'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth', 'role:utdc', 'update.last.seen'])
                ->prefix('utdc')
                ->as('utdc.')
                ->group(base_path('routes/utdc.php'));


            Route::middleware(['web', 'auth', 'role:pao', 'check.enrollment.window', 'update.last.seen'])
                ->prefix('pao')
                ->as('pao.')
                ->group(base_path('routes/pao.php'));


            Route::middleware(['web', 'auth', 'role:aro', 'update.last.seen'])
                ->prefix('aro')
                ->as('aro.')
                ->group(base_path('routes/aro.php'));

            Route::middleware(['web', 'auth', 'role:dean', 'update.last.seen'])
                ->prefix('dean')
                ->as('dean.')
                ->group(base_path('routes/dean.php'));
            Route::middleware(['web', 'auth', 'role:osa', 'update.last.seen'])
                ->prefix('osa')
                ->as('osa.')
                ->group(base_path('routes/osa.php'));

        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'csrf.except.api' => ExcludeApiRoutesFromCsrf::class, // Register the CSRF exclusion middleware
            'update.last.seen' => UpdateLastSeen::class, // Register the alias
            'check.enrollment.window' => CheckEnrollmentPeriod::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'api/confirmation'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
