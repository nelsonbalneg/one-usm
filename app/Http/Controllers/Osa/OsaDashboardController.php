<?php

namespace App\Http\Controllers\Osa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OsaDashboardController extends Controller
{
    public function index()
    {
        return view('osa.dashboard');
    }
}
