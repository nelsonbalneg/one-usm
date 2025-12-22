
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Osa\OsaDashboardController;
// route for dashboard
Route::get('dashboard', [OsaDashboardController::class, 'index'])->name('dashboard');
