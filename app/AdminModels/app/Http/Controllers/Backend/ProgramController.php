<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    public function index()
    {
        return view('admin.prereg.program.program');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

            if ($response->successful()) {
                $programs = collect($response->json());

                return DataTables::of($programs)
                    ->addIndexColumn()
                    ->addColumn('programName', function ($row) {
                        $major = !empty($row['majorDiscDesc']) ? ' - ' . $row['majorDiscDesc'] : '';

                        return '<strong>' . strtoupper($row['programName']) . $major . '</strong>'
                            . ' <b>(' . $row['programCode'] . ')</b><br>'
                            . '<span class="text-custom-500">' . $row['realCampus'] . '</span> - '
                            . '<span class="text-green-500">' . $row['collegeName'] . '</span>';
                    })
                    ->addColumn('limit', function ($row) {
                        $programlimit = 0;
                        if (!is_null($row['majorDiscId'])) {
                            $programlimit = $row['majorLimit'];
                        } else {
                            $programlimit = $row['programLimit'];
                        }
                        return $programlimit;
                    })
                    ->addColumn('reservation_status', function ($row) {
                        if ($row['reservationStatus'] == 'Closed') {
                            return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20">Closed</span>';
                        } else {
                            return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">Open</span>';
                        }
                    })
                    ->addColumn('ranking_status', function ($row) {
                        if ($row['openForRanking'] == false) {
                            return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20">Close</span>';
                        } else {
                            return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20">Open</span>';
                        }
                    })
                    ->rawColumns(['programName', 'programlimit', 'reservation_status', 'ranking_status'])
                    ->make(true);
            }

            return response()->json(['message' => 'Failed to fetch programs'], 500);
        }

        return abort(404);
    }

    public function getProgramPolicyDetailsIndex($policyId)
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        if ($response->successful()) {
            $programs = $response->json();

            // Adjust depending on structure of the response (either a flat array or nested in 'data')
            $programList = $programs['data'] ?? $programs;

            // Find the program with the matching policyId
            $program = collect($programList)->firstWhere('id', $policyId);
        }

        return view('admin.prereg.program.update-program', compact('program', 'policyId'));
    }

    public function updateProgramPolicy(Request $request)
    {
        $validated = $request->validate([
            'policyId' => 'required|integer',
            'programName' => 'required|string',
            'majorDiscDesc' => 'nullable|string',
            'usmceefp' => 'nullable|numeric',
            'pendingLimit' => 'nullable|integer',
        ]);

        // Step 1: Get current program policy by ID
        $policyId = $validated['policyId'];

        // 2. Fetch the policy from the STAGING API using policyId
        $response = Http::get("http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs");

        if (!$response->ok()) {
            return response()->json(['error' => 'Failed to fetch policy data from API'], 500);
        }

        // 3. Find the matching policy by ID
        $policies = $response->json();
        $policy = collect($policies)->firstWhere('id', (int) $policyId);

        if (!$policy) {
            return response()->json(['error' => 'Policy not found'], 404);
        }

        // 4. Update fields from form input
        $policy['programName'] = $validated['programName'];
        $policy['majorDiscDesc'] = $validated['majorDiscDesc'] ?? $policy['majorDiscDesc'];
        $policy['usmceefp'] = (float) ($validated['usmceefp'] ?? $policy['usmceefp']);
        $policy['pendingLimit'] = (int) ($validated['pendingLimit'] ?? $policy['pendingLimit']);

        // 5. Send PUT request to MAIN API with complete payload
        $updateResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json-patch+json',
            'x-api-version' => '2.0',
        ])->put('http://172.16.0.60/academic/api/v2/ProgramPolicies', $policy);

        // 6. Return response
        if ($updateResponse->successful()) {
            return redirect()->route('admin.prereg.program-policy-details.index', ['policyId' => $request->policyId])->with('success', 'Policy updated successfully');
        } else {
            return redirect()->route('admin.prereg.program-policy-details.index', ['policyId' => $request->policyId])->with('error', 'Failed to update policy on main API');
        }
    }

}
