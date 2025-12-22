<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\ConfirmReservationController;
use App\Http\Controllers\Student\StudentCeeReserveController;


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest'); // Apply 'guest' middleware here


Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user) {
        // Check the user's role and redirect accordingly
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'utdc' => redirect()->route('utdc.dashboard'),
            'pao' => redirect()->route('pao.dashboard'),
            'aro' => redirect()->route('aro.dashboard'),
            'dean' => redirect()->route('dean.dashboard'),
            'osa' => redirect()->route('osa.dashboard'),
        };
    }
    return redirect()->route('login');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::prefix('api')
    ->middleware(['csrf.except.api'])
    ->group(function () {
        Route::get('programs', [StudentCeeReserveController::class, 'getProgramsByTenant']);
        Route::post('confirmation', [ConfirmReservationController::class, 'confirmationStatus']);
    });


require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->back() ?? redirect('/');
});
