<?php

namespace App\Http\Controllers\Pao;


use Illuminate\Http\Request;
use App\Models\StundentProfile;
use App\Models\StudentRequirement;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ConfirmedStudentsController extends Controller
{
    public function index()
    {
        return view('pao.students.index');
    }

    public function cancelConfirmation(Request $request, $id)
    {
        $userId = Auth::id();
        $baseUrl = config('academic.base_url');

        $student = StundentProfile::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $reason = $request->input('reason');

        if (!$reason) {
            return response()->json(['message' => 'Cancellation reason is required'], 400);
        }

        // External API endpoint
        $externalApiUrl = "{$baseUrl}CeeV/reset-applicant/{$id}?reason=" . urlencode($reason);

        // Send DELETE request
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->delete($externalApiUrl);

         // Check if the API call was successful
        if ($response->successful()) {
            //Update student status only if API call succeeded
            $student->prereg_status = null;
            $student->status_id = null;
            $student->policyId = null;
            $student->prog_id = null;
            $student->campus_id = null;
            $student->remarks = $reason;
            $student->status_remarks = 'Cancelled by'.$userId;
            $student->save();

            return response()->json(['message' => 'Preregistration has been cancelled'], 200);
        } else {
            // Log failure details
            try {
                $responseData = $response->json();
            } catch (\Exception $e) {
                $responseData = ['response' => $response->body()];
            }

            Log::error('Failed to cancel preregistration', [
                'url' => $externalApiUrl,
                'response' => $responseData,
            ]);

            return response()->json([
                'message' => 'Failed to cancel preregistration',
                'details' => $responseData
            ], $response->status());
        }


        // // Safely handle and log the API response
        // try {
        //     $responseData = $response->json();
        // } catch (\Exception $e) {
        //     $responseData = ['response' => $response->body()];
        // }

        // // Optionally log the API response for debugging
        // Log::info('API response from cancelConfirmation', [
        //     'url' => $externalApiUrl,
        //     'response' => $responseData,
        // ]);

        // // Update student status
        // $student->prereg_status = null;
        // $student->status_id = null;
        // $student->policyId = null;
        // $student->prog_id = null;
        // $student->campus_id = null;
        // $student->remarks = $reason;
        // $student->status_remarks = 'Cancelled';
        // $student->save();

        // return response()->json(['message' => 'Preregistration has been cancelled'], 200);
    }


    public function getData(Request $request)
    {
        $userId = Auth::id();
        $columns = [
            'sp.id',
            'sp.student_no',
            'sp.student_type',
            'sp.app_no',
            'sp.last_name',
            'sp.first_name',
            'sp.gender',
            'sp.campusName',
            'sp.applicant_profile_status',
            'sp.programName',
            'sp.status_id',
            'sp.prereg_status',
            'r.csa',
            'r.status',
            'sp.majorDiscDesc',
            'u.photo',
            'sp.termId',
            'sp.user_id',
        ];

        $length = $request->input('length', 10);
        $start = $request->input('start', 0);
        $columnIndex = $request->input('order')[0]['column'] ?? 0;
        $dir = $request->input('order')[0]['dir'] ?? 'asc';
        $search = $request->input('search')['value'] ?? '';

        if (!isset($columns[$columnIndex])) {
            $columnIndex = 0;
        }

        $query = DB::table('stundent_profiles as sp')
            ->join('users_assigned_program as uap', 'sp.policyId', '=', 'uap.policyId')
            ->leftJoin('results as r', 'sp.user_id', '=', 'r.user_id')
            ->leftJoin('student_requirements as sr', 'sp.id', '=', 'sr.student_id')
            ->leftJoin('users as u', 'sp.user_id', '=', 'u.id')
            ->select(
                'sp.id',
                'sp.student_no',
                'sp.app_no',
                'sp.student_type',
                'sp.last_name',
                'sp.first_name',
                'sp.middle_name',
                'sp.gender',
                'sp.policyId',
                'sp.campusName',
                'sp.programName',
                'sp.applicant_profile_status',
                'sp.majorDiscDesc',
                'sp.status_id',
                DB::raw("CONCAT(sp.programName, ' - ', sp.majorDiscDesc) as programWithMajor"),
                'sp.prereg_status',
                'r.csa',
                'r.status',
                'sr.goodmoral',
                'sr.card',
                'sr.psa',
                'sr.hdismissal',
                'sr.certificatetransfer',
                'sr.transcript',
                'sr.affidavit',
                'u.photo',
                'sp.termId',
                'sp.user_id'
            )
            ->where(function ($q) {
                $q->where('sp.status_id', 0)
                    ->orWhere('sp.status_id', 1)
                    ->orWhereNull('sp.status_id');
            })
            ->where('uap.user_id', $userId)
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('sp.student_type', 1)
                        ->where(function ($s) {
                            $s->where('sr.goodmoral', 1)
                                ->orWhere('sr.psa', 1)
                                ->orWhere('sr.card', 1)
                                ->orWhere('sr.affidavit',1);
                        });
                })
                    ->orWhere(function ($sub) {
                        $sub->where('sp.student_type', 2)
                            ->where(function ($s) {
                                $s->where('sr.goodmoral', 1)
                                    ->orWhere('sr.hdismissal', 1)
                                    ->orWhere('sr.certificatetransfer', 1)
                                    ->orWhere('sr.psa', 1)
                                    ->orWhere('sr.transcript', 1)
                                    ->orWhere('sr.affidavit',1);
                            });
                    })
                    ->orWhere(function ($sub) {
                        $sub->where('sp.student_type', 3);
                    });
            });


        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sp.student_no', 'like', "%{$search}%")
                    ->orWhere('sp.app_no', 'like', "%{$search}%")
                    ->orWhere('sp.last_name', 'like', "%{$search}%")
                    ->orWhere('sp.first_name', 'like', "%{$search}%")
                    ->orWhere('sp.programName', 'like', "%{$search}%")
                    ->orWhere('r.status', 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(sp.programName, ' - ', sp.majorDiscDesc)"), 'like', "%{$search}%");
            });
        }

        $filteredRecords = $query->count();

        $results = $query
            ->orderBy($columns[$columnIndex], $dir)
            ->skip($start)
            ->take($length)
            ->get();

        $data = $results->map(function ($item) {
            $studentTypes = [
                1 => 'New Student',
                2 => 'Transferee',
                3 => 'Shifty',
            ];

            $studentTypeBadges = [
                1 => 'green',    // New Student
                2 => 'blue',     // Transferee
                3 => 'yellow',   // Shifty
            ];

            // Convert photo to base64
            // $photoPath = public_path($item->photo);
            // if ($item->photo && file_exists($photoPath)) {
            //     $imageData = base64_encode(file_get_contents($photoPath));
            //     $mimeType = mime_content_type($photoPath);
            //     $base64Photo = "data:$mimeType;base64,$imageData";
            // } else {
            //     $base64Photo = asset('images/default-avatar.png'); // fallback
            // }

            return [
                'id' => $item->id,
                'student_no' => $item->student_no,
                'student_type' => isset($studentTypes[$item->student_type])
                    ? "<span class='inline-block bg-{$studentTypeBadges[$item->student_type]}-100 text-{$studentTypeBadges[$item->student_type]}-800 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-{$studentTypeBadges[$item->student_type]}-900 dark:text-{$studentTypeBadges[$item->student_type]}-300 mb-1'>{$studentTypes[$item->student_type]}</span>"
                    : 'Unknown',
                'app_no' => $item->app_no,
                'fullname' => "<li class='flex items-center gap-3 py-2 first:pt-0 last:pb-0'>
                        <div class='w-12 h-12 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600'>
                            <img src='http://172.16.0.43/uploads/" . basename($item->photo) . "' alt='Student Photo' class='w-12 h-12 rounded-full'>
                        </div>
                        <div class='grow'>
                            <h6 class='font-medium'>" . strtoupper($item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_name ?? '')) . "</h6>
                            <p class='text-slate-500 dark:text-zink-200'>{$item->app_no}</p>
                        </div>
                    </li>",
                'gender' => $item->gender,
                'campusName' => $item->campusName,
                'program' => "<span class='text-slate-500'>{$item->campusName}</span><br><span class='font-bold'>{$item->programName}</span>" . ($item->majorDiscDesc ? " - {$item->majorDiscDesc}" : ""),
                'applicant_profile_status' => match ($item->applicant_profile_status) {
                    '0' => "<span class='inline-block bg-yellow-200 text-yellow-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 mb-1'>Draft</span>",
                    '1' => "<span class='inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>Published</span>",
                    default => $item->applicant_profile_status ?? '---',
                },
                'major' => $item->majorDiscDesc,
                'csa' => $item->csa,
                'status' => $item->status,
                'status_id' => match (true) {
                    $item->status_id === null => "<span class='inline-block bg-yellow-200 text-yellow-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 mb-1'>Pending</span>",
                    $item->status_id === '1' => "<span class='inline-block bg-green-200 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>Enrolled</span>",
                    $item->status_id === '2' => "<span class='inline-block bg-red-200 text-red-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 mb-1'>Cancelled</span>",
                    $item->status_id === '0' => "<span class='inline-block bg-sky-200 text-black-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-sky-900 dark:text-sky-300 mb-1'>For Assessment</span>",
                    default => $item->status_id ?? '---',
                },
                'requirements' => collect([
                    'Good Moral' => $item->goodmoral,
                    'Card' => $item->card,
                    'PSA' => $item->psa,
                    'H. Dismissal' => $item->hdismissal,
                    'Cert. Transfer' => $item->certificatetransfer,
                    'Transcript' => $item->transcript,
                    'Affidavit' => $item->affidavit
                ])->filter(fn($v) => $v == 1)->map(fn($v, $k) => "<span class='inline-block bg-green-100 text-green-500 text-xs font-medium mr-1 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-1'>{$k}</span><br>")->implode(' '),
                'actions' => view('pao.students.action-buttons', [
                    'id' => $item->id,
                    'termId' => $item->termId,
                    'student_type' => $item->student_type,
                    'enrollmentStatus' => $item->prereg_status,
                    'policyId' => $item->policyId,
                    'user_id' => $item->user_id,
                    'status_id' => $item->status_id,
                    'fullname' => $item->last_name . ', ' . $item->first_name . ' ' . ($item->middle_name ?? '')
                ])->render()
            ];
        });

        return response()->json([
            'data' => $data,
            'recordsTotal' => DB::table('stundent_profiles')
                ->where(function ($q) {
                    $q->where('prereg_status', 'pending')
                        ->orWhere('prereg_status', 'enrolled');
                })
                ->count(),
            'recordsFiltered' => $filteredRecords,
        ]);
    }

}
