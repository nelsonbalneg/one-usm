<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DetectWebView;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::middleware(['guest', DetectWebView::class, 'check.maintenance'])->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create']);
});

Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);


Route::middleware(['auth', 'verified', 'check.maintenance'])->group(function () {
    Route::get('/dashboard', function () {
        // $user = auth()->user();

        $user = Auth::user();
        if ($user) {
            // Check the user's role and redirect accordingly
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'student' => redirect()->route('student.dashboard'),
                'aro' => redirect()->route('aro.dashboard'),
                'osa' => redirect()->route('osa.dashboard'),
                'parent' => redirect()->route('parent.dashboard'),
                default => redirect()->route('dashboard.default'),
            };
        }
        return redirect()->route('login');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['check.maintenance'])->group(function () {
    // Route::get('reservation/{id}/{app_no}', [ReservationController::class, 'getReservationByIdAndAppNo']);
    // Route::post('reservation-details', [ReservationDetailsController::class, 'store']);

    Route::get('/webview-instruction', function () {
        return view('webview.instruction');
    })->name('webview.instruction');
});

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->back() ?? redirect('/');
});


