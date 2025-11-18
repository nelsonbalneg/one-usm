<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\AdminController;

  Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
