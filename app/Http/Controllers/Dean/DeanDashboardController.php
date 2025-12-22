<?php

namespace App\Http\Controllers\Dean;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UsersAssignedProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DeanDashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        $programs = [];
        if ($response->successful()) {
            $programs = $response->json();
        }

        // Get the logged-in user's ID
        $userId = Auth::user()->id;

        // Get the user's assigned policy IDs
        $selectedPolicyIds = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        $counts = [];
        $totalCounts = [
            'pending_for_enrollment' => 0,
            'for_assessment' => 0,
            'enrolled' => 0,
        ];

        foreach ($selectedPolicyIds as $policyId) {
            $counts[$policyId] = [
                'pending_for_enrollment' => DB::table('stundent_profiles')
                    ->where('policyId', $policyId)
                    ->where('prereg_status', 'pending')
                    ->whereNull('status_id')
                    ->count(),

                'for_assessment' => DB::table('stundent_profiles')
                    ->where('policyId', $policyId)
                    ->where('prereg_status', 'pending')
                    ->where('status_id', 0)
                    ->count(),

                'enrolled' => DB::table('stundent_profiles')
                    ->where('policyId', $policyId)
                    ->where('prereg_status', 'enrolled')
                    ->where('status_id', 1)
                    ->count(),
            ];

            // Add to total
            $totalCounts['pending_for_enrollment'] += $counts[$policyId]['pending_for_enrollment'];
            $totalCounts['for_assessment'] += $counts[$policyId]['for_assessment'];
            $totalCounts['enrolled'] += $counts[$policyId]['enrolled'];
        }

        //get the PAO
        $paoUsers = UsersAssignedProgram::join('users', 'users.id', '=', 'users_assigned_program.user_id')
            ->where('users.role', 'like', 'pao')
            ->select('users_assigned_program.policyId', 'users.firstname', 'users.lastname')
            ->get()
            ->groupBy('policyId')
            ->map(function ($group) {
                return $group->map(function ($user) {
                    return $user->lastname . ', ' . $user->firstname;
                })->join(', ');
            })
            ->toArray();

        // Filter the programs using the selected policy IDs
        $selectedPrograms = collect($programs)->filter(function ($program) use ($selectedPolicyIds) {
            return in_array($program['id'], $selectedPolicyIds);
        })->map(function ($program) {
            return [
                'programName' => $program['programName'],
                'majorDiscDesc' => $program['majorDiscDesc'],
                'realCampus' => $program['realCampus'],
                'collegeName' => $program['collegeName'],
                'term' => $program['term'],
                'policyId' => $program['id'],
            ];
        })->values();

        return view('dean.dashboard', compact('selectedPrograms', 'counts', 'totalCounts', 'paoUsers'));
    }
}
