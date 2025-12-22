<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search `reservations` table for `app_no`
        $reservations = Reservation::where('app_no', 'LIKE', "%{$query}%")->get();

        // Search `users` table for `name` or `email`
        $users = User::where('firstname', 'LIKE', "%{$query}%")
                     ->orWhere('email', 'LIKE', "%{$query}%")
                     ->get();

        // Combine results
        $results = [
            'reservations' => $reservations,
            'users' => $users,
        ];

        return response()->json($results);
    }
}
