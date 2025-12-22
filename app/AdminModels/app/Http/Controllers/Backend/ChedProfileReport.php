<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ChedApplicantProfile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ChedApplicantProfileRequest;

class ChedProfileReport extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userid = Crypt::decryptString($request->id);


        //get the application number with confirmed status
        $app_no = Reservation::where('user_id', $userid)
            ->where('status', 'confirmed')->first();

        //get the existing details of the user during registration
        $cee_profile = User::where('id', $userid)->first();

        $applicant = ChedApplicantProfile::where('user_id', $userid)->first() ?? new ChedApplicantProfile();
        $is_applicant_exist = ChedApplicantProfile::where('user_id', $userid)->first();

        // Read religions.json file
        $religions = [];
        $path = public_path('backend/assets/religion/religions.json'); // Ensure the path is correct
        if (File::exists($path)) {
            $religions = json_decode(File::get($path), true);
        }

        // Read nationality.json file
        $nationalities = [];
        $path_nationality = public_path('backend/assets/nationality/nationality.json'); // Ensure the path is correct
        if (File::exists($path_nationality)) {
            $nationalities = json_decode(File::get($path_nationality), true);
        }

        // Read tribes.json file
        $tribes = [];
        $path_tribe = public_path('backend/assets/tribe/tribes.json'); // Ensure the path is correct
        if (File::exists($path_tribe)) {
            $tribes = json_decode(File::get($path_tribe), true);
        }

        return view(
            'admin.profile.ched-profile',
            compact(
                'cee_profile',
                'applicant',
                'is_applicant_exist',
                'religions',
                'nationalities',
                'tribes',
                'app_no'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChedApplicantProfileRequest $request)
    {
        try {
            DB::beginTransaction();


            $data = $request->validated();

            // Trim all string values in the validated data
            $data = array_map(function ($value) {
                return is_string($value) ? trim($value) : $value;
            }, $data);


            // Check if user_id exists and update or create
            ChedApplicantProfile::updateOrCreate(
                ['user_id' => $data['user_id']],
                $data
            );

            DB::commit();

            return redirect()->back()->fallback(route('admin.cee.ched-profile.index'))->with('success', 'USMCEE Applicant Profile saved! Please proceed to the next step.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->fallback(route('admin.cee.ched-profile.index'))
                ->withErrors(['error' => 'Something went wrong while saving the application. Please try again.'])
                ->withInput();
        }
    }

    public function publish($id)
    {
        try {


            $studentProfile = ChedApplicantProfile::where('user_id', $id)->first();

            if (!$studentProfile) {

                return response()->json(['success' => false, 'message' => 'Applicant profile not found.'], 404);
            }
            $studentProfile->update(['status' => '1']);

            return response()->json(['success' => true, 'message' => 'Applicant profile published successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function ched_profile_report_index()
    {
        $ceeSessions = CeeSession::all();
        $activecee_session = CeeSession::where('status', 'active')->first();

        if ($activecee_session) {
            $activeTermId = $activecee_session->id;

            // Count only profiles under the active term
            $count_draft = ChedApplicantProfile::where('cee_term_id', $activeTermId)
                ->where('status', 0)
                ->count();

            $count_published = ChedApplicantProfile::where('cee_term_id', $activeTermId)
                ->where('status', 1)
                ->count();

            $count_all_profile = ChedApplicantProfile::where('cee_term_id', $activeTermId)
                ->count();
        } else {
            // In case there’s no active term
            $count_draft = 0;
            $count_published = 0;
            $count_all_profile = 0;
        }

        return view('admin.report.ched-profile', compact('activecee_session', 'ceeSessions', 'count_draft', 'count_published', 'count_all_profile'));
    }

    public function getChedData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('ched_applicant_profiles')
                ->leftJoin('users', 'ched_applicant_profiles.user_id', '=', 'users.id')
                ->leftJoin('cee_sessions', 'ched_applicant_profiles.cee_term_id', '=', 'cee_sessions.id')
                ->select(
                    DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname"),
                    'ched_applicant_profiles.status',
                    'ched_applicant_profiles.updated_at',
                    'ched_applicant_profiles.app_no',
                    'ched_applicant_profiles.id',
                    'ched_applicant_profiles.user_id',
                )
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('ched_applicant_profiles.cee_term_id', $request->cee_session_id);
                });

            return DataTables::of($data)
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.firstname, ' ', users.lastname, ' ', ISNULL(users.suffix, '')) like ?", ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($row) {
                    $encrypteduserid = Crypt::encryptString($row->user_id);
                    return '<div class="flex gap-3">
                            <a href=' . route('admin.cee.ched-profile.index', ['id' => $encrypteduserid]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-detail size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        </div>';
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 1) {
                        return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> Published</span>';
                    } elseif ($query->status == 0) {
                        return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20"> Draft</span>';
                    }
                })
                ->editColumn('updated_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('F j, Y \a\t h:i A');
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
