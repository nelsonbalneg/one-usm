<?php

use App\Http\Controllers\Dean\DeanDashboardController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', [DeanDashboardController::class, 'index'])->name('dashboard');
