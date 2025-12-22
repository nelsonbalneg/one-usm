<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Result;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\StundentProfile;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\PreregistrationTerm;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class PreregProfileController extends Controller
{
    public function showStep1(Request $request, $id)
    {
        $userId = $id;

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

        $applicant = StundentProfile::where('id', $userId)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('user_id', $userId)->first();

        //resident address
        $applicant->res_region = $applicant->res_region ?? '';
        $applicant->res_province = $applicant->res_province ?? '';
        $applicant->res_towncity = $applicant->res_towncity ?? '';
        $applicant->res_barangay = $applicant->res_barangay ?? '';

        //permanent address
        $applicant->perm_address = $applicant->perm_address ?? '';
        $applicant->perm_address_province = $applicant->perm_address_province ?? '';
        $applicant->perm_address_towncity = $applicant->perm_address_towncity ?? '';
        $applicant->perm_address_barangay = $applicant->perm_address_barangay ?? '';

        //fetch the Sitesettings
        $site_settings = DB::table('site_settings')->first();

        return view("admin.prereg.profile.step1", compact(

            'religions',
            'nationalities',
            'tribes',
            'is_applicant_exist',
            'applicant',

        ));
    }

    public function postStep1(Request $request)
    {

        //fetch the active prereg_term
        $prereg_term = PreregistrationTerm::where('status', 1)->first();
        $active_prereg_id = $prereg_term->id;


        $userId = $request->user_id;
        $applicant_profile_id = $request->applicant_prof_id;

        $validated = $request->validate([

            'app_no' => [
                'required',
                Rule::unique('stundent_profiles', 'app_no')->ignore($userId, 'user_id') // Ignore the current user's email
            ],
            'user_id' => [
                'required',
                Rule::unique('stundent_profiles', 'user_id')->ignore($userId, 'user_id') // Ignore the current user's email
            ],
            'email' => [
                'required',
                Rule::unique('stundent_profiles', 'email')->ignore($userId, 'user_id') // Ignore the current user's email
            ],

            'student_type' => 'required|integer',
            'freshmen_type' => 'required|integer',
            'student_no' => 'nullable|string|max:15',
            'campus_id' => 'nullable|integer',
            'prog_id' => 'nullable|integer',
            'major_disc_id' => 'nullable|integer',
            'year_level_id' => 'nullable|integer',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'first_name' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:5',
            'ext_name' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:200',
            'civil_status_id' => 'required|integer',
            'religion_id' => 'required|integer',
            'gender' => 'required|string|in:Male,Female,Other',
            'nationality_id' => 'required|integer',
            'mobile_no' => 'required|string|max:20',
            'health_id' => 'nullable|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'blood_type' => 'required|string|max:3',

            'no_of_brothers' => 'required|integer',
            'no_of_sisters' => 'required|integer',
            'is_illegitimate_child' => 'required|boolean',
            'tribe_id' => 'required|integer',

            'ip_member' => 'required|boolean',
            'ip_member_tribe' => 'nullable|string|max:50',

            'pwd_member' => 'required|boolean',
            'pwd_member_id' => 'nullable|string|max:50',
            'pwd_category' => 'nullable|string|max:50',
            'solo_parent' => 'required|boolean',
            'solo_parent_id' => 'nullable|string|max:50',

            // Residence Address
            'res_address' => 'nullable|string|max:255',
            'res_street' => 'required|string|max:100',
            'barangay_text-res' => 'required|string|max:100',
            'city_text-res' => 'required|string|max:100',
            'res_zipcode' => 'nullable|integer',
            'province_text-res' => 'required|string|max:100',
            'region_text-res' => 'required|string|max:100',

            // Permanent Address
            'perm_address' => 'nullable|string|max:1000',
            'perm_street' => 'required|string|max:100',
            'barangay_text-perm' => 'required|string|max:1000',
            'city_text-perm' => 'required|string|max:100',
            'perm_zipcode' => 'required|integer',
            'province_text-perm' => 'required|string|max:60',
            'region_text-perm' => 'required|string|max:60',
            'status_id' => 'nullable|integer|max:3',


        ]);

        DB::beginTransaction();

        try {
            // Clean string data
            $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

            $data['middle_initial'] = $request->input('middle_name')
                ? strtoupper(substr($request->input('middle_name'), 0, 1)) . '.'
                : null;

            $data['res_region'] = $data['region_text-res'];
            $data['res_province'] = $data['province_text-res'];
            $data['res_towncity'] = $data['city_text-res'];
            $data['res_barangay'] = $data['barangay_text-res'];

            $data['res_address'] = implode(', ', array_filter([
                $request->input('res_street'),
                $request->input('barangay_text-res'),
                $request->input('city_text-res'),
                $request->input('province_text-res'),
                $request->input('res_zipcode')
            ]));

            $data['perm_region'] = $data['region_text-perm'];
            $data['perm_province'] = $data['province_text-perm'];
            $data['perm_towncity'] = $data['city_text-perm'];
            $data['perm_barangay'] = $data['barangay_text-perm'];

            $data['perm_address'] = implode(', ', array_filter([
                $request->input('perm_street'),
                $request->input('barangay_text-perm'),
                $request->input('city_text-perm'),
                $request->input('province_text-perm'),
                $request->input('perm_zipcode')
            ]));

            $data['applicant_profile_status'] = 0;
            $data['current_step'] = 1;
            $data['prereg_term_id'] = $active_prereg_id;

            Log::info('Final data to be saved for user ' . $userId, $data);

            // Save the profile
            $studentProfile = StundentProfile::updateOrCreate(
                ['id' => $applicant_profile_id],
                $data
            );

            DB::commit();

            return redirect()->route('admin.applicant-profile.step2.show', ['id' => $request->applicant_prof_id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving personal info: ' . $e->getMessage());
            return redirect()->route('admin.applicant-profile.step1.show', ['id' => $request->applicant_prof_id])->with('error', 'Something went wrong while saving.');
        }
    }

    public function showStep2(Request $request, $id)
    {

        $userId = $id;


        $applicant = StundentProfile::where('id', $userId)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('id', $userId)->first();

        //guardian address
        $applicant->guardian_address = $applicant->guardian_address ?? '';
        $applicant->guardian_address_province = $applicant->guardian_address_province ?? '';
        $applicant->guardian_address_towncity = $applicant->guardian_address_towncity ?? '';
        $applicant->guardian_address_barangay = $applicant->guardian_address_barangay ?? '';


        return view('admin.prereg.profile.step2', compact(
            'applicant',
            'is_applicant_exist'
        ));
    }

    public function postStep2(Request $request)
    {
        $userId = $request->user_id;
        $applicant_profile_id = $request->applicant_prof_id;


        $validated = $request->validate([
            'father' => 'nullable|string|max:50',
            'father_birth_date' => 'nullable',
            'father_educ_attain' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:50',
            'father_company' => 'nullable|string|max:100',
            'father_company_address' => 'nullable|string|max:200',
            'father_tel_no' => 'nullable|string|max:20',
            'father_email' => 'nullable|string|max:50',
            'father_income_from' => 'nullable|string',

            'mother' => 'nullable|string|max:50',
            'mother_birth_date' => 'nullable',
            'mother_educ_attain' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:50',
            'mother_company' => 'nullable|string|max:100',
            'mother_company_address' => 'nullable|string|max:200',
            'mother_tel_no' => 'nullable|string|max:20',
            'mother_email' => 'nullable|string|max:50',
            'mother_income_from' => 'nullable|string',

            'father_income_to' => 'nullable|string',
            'mother_income_to' => 'nullable|string',

            // Guardian Information
            'guardian' => 'required|string|max:100',
            'guardian_relationship' => 'required|string|max:100',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_company' => 'nullable|string|max:100',
            'guardian_telno' => 'nullable|string|max:100',
            'guardian_email' => 'nullable|string|max:100',

            'guardian_address' => 'nullable|string|max:100',
            'guardian_street' => 'required|string|max:100',
            'barangay_text-guardian' => 'required|string|max:100',
            'city_text-guardian' => 'required|string|max:100',
            'province_text-guardian' => 'required|string|max:100',
            'region_text-guardian' => 'required|string|max:100',
            'guardian_zipcode' => 'nullable|integer'
        ]);

        DB::beginTransaction();

        try {
            // Clean string data
            $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

            $data['guardian_region'] = $data['region_text-guardian'];
            $data['guardian_province'] = $data['province_text-guardian'];
            $data['guardian_towncity'] = $data['city_text-guardian'];
            $data['guardian_barangay'] = $data['barangay_text-guardian'];

            // Concatenate and remove extra spaces
            $data['guardian_address'] = implode(', ', array_filter([
                $request->input('guardian_street'),
                $request->input('barangay_text-guardian'),
                $request->input('city_text-guardian'),
                $request->input('province_text-guardian'),
                $request->input('guardian_zipcode')
            ]));

            // Set current_step
            $data['current_step'] = 2;

            Log::info('Final data to be saved for user ' . $userId, $data);

            // Save the profile
            StundentProfile::updateOrCreate(
                ['id' => $applicant_profile_id],
                $data
            );

            DB::commit();

            return redirect()->route('admin.applicant-profile.step3.show', ['id' => $request->applicant_prof_id]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving personal info: ' . $e->getMessage());
            return redirect()->route('admin.applicant-profile.step2.show', ['id' => $request->applicant_prof_id])->with('error', 'Something went wrong while saving.');
        }
    }

    public function showStep3($id)
    {
        $applicant = StundentProfile::where('id', $id)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('id', $id)->first();

        return view('admin.prereg.profile.step3', compact('applicant', 'is_applicant_exist'));
    }

    public function postStep3(Request $request)
    {
        $userId = $request->user_id;
        $applicant_profile_id = $request->applicant_prof_id;

        $validated = $request->validate([
            'elem_school' => 'required|string|max:100',
            'elem_address' => 'required|string|max:100',
            'elem_incldates' => 'required|string|max:60',
            'hs_school' => 'required|string|max:100',
            'hs_address' => 'required|string|max:100',
            'hs_incldates' => 'required|string|max:60',
            'vocational' => 'nullable|string|max:100',
            'vocational_address' => 'nullable|string|max:100',
            'vocational_degree' => 'nullable|string|max:100',
            'vocational_incldates' => 'nullable|string|max:60',
            'shs_school' => 'required|string|max:100',
            'shs_address' => 'required|string|max:100',
            'shs_incldates' => 'required|string|max:60',
            'college_school' => 'required|string|max:100',
            'college_address' => 'required|string|max:100',
            'college_degree' => 'required|string|max:100',
            'college_incldates' => 'required|string|max:60',
            'student_picture' => 'nullable|file',
            'elem_award_honor' => 'nullable|string|max:1000',
            'hs_award_honor' => 'nullable|string|max:1000',
            'shs_award_honor' => 'nullable|string|max:1000',
        ]);



        DB::beginTransaction();

        try {
            // Clean string data
            $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

            // Set current_step
            $data['current_step'] = 3;

            // Save the profile
            $studentProfile = StundentProfile::updateOrCreate(
                ['id' => $applicant_profile_id],
                $data
            );

            DB::commit();

            return redirect()->route('admin.applicant-profile.step4.show', ['id' => $request->applicant_prof_id])->with('student_profile_id', $studentProfile->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Educational Background info: ' . $e->getMessage());
            return redirect()->route('admin.applicant-profile.step3.show', ['id' => $request->applicant_prof_id])->with('error', 'Something went wrong while saving.');
        }
    }

    public function showStep4($id)
    {
        $applicant = StundentProfile::where('id', $id)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('id', $id)->first();

        return view('admin.prereg.profile.step4', compact('applicant', 'is_applicant_exist'));
    }

    public function postStep4(Request $request)
    {
        $userId = $request->user_id;
        $applicant_profile_id = $request->applicant_prof_id;

        $validated = $request->validate([
            'emergency_contact' => 'required|string|max:100',
            'emergency_address' => 'required|string|max:100',
            'emergency_mobileno' => 'required|string|max:60',
            'emergency_telno' => 'nullable|string|max:60',
        ]);

        DB::beginTransaction();

        try {
            // Clean string data
            $data = array_map(fn($value) => is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value, $validated);

            // Set current_step
            $data['current_step'] = 4;

            // Save the profile
            $studentProfile = StundentProfile::updateOrCreate(
                ['id' => $applicant_profile_id],
                $data
            );

            DB::commit();

            return redirect()->route('admin.applicant-profile.step5.show', ['id' => $request->applicant_prof_id])->with('student_profile_id', $studentProfile->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Educational Background info: ' . $e->getMessage());
            return redirect()->route('admin.applicant-profile.step3.show', ['id' => $request->applicant_prof_id])->with('error', 'Something went wrong while saving.');
        }
    }

    public function showStep5($id)
    {


        $applicant = StundentProfile::where('id', $id)->first() ?? new StundentProfile();
        $is_applicant_exist = StundentProfile::where('id', $id)->first();

        return view('admin.prereg.profile.step5', compact('applicant', 'is_applicant_exist'));
    }

    public function unpost($id)
    {
        try {

            // Find the user's student profile
            $studentProfile = StundentProfile::find($id);

            if (!$studentProfile) {
                return response()->json(['success' => false, 'message' => 'Student profile not found.'], 404);
            }

            // Update profile status to published (1)
            $studentProfile->update(
                [
                    'applicant_profile_status' => 0,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Student profile unposted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function publish($id)
    {
        try {

            // Find the user's student profile
            $studentProfile = StundentProfile::find($id);

            if (!$studentProfile) {
                return response()->json(['success' => false, 'message' => 'Student profile not found.'], 404);
            }

            // Update profile status to published (1)
            $studentProfile->update(
                [
                    'applicant_profile_status' => 1,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Student profile published successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function addApplicantIndex()
    {


        $users = DB::table('users as u')
            ->leftJoin('cee_sessions as cs', 'cs.id', '=', 'u.exam_session_id')
            ->select('u.id', 'u.firstname', 'u.middlename', 'u.lastname')
            ->where('cs.status', 'active')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('ched_applicant_profiles as cap')
                    ->whereColumn('cap.user_id', 'u.id')
                    ->where('cap.status', 1);
            })
            ->where(function ($query) {
                $query->whereNotExists(function ($subQuery) {
                    $subQuery->select(DB::raw(1))
                        ->from('stundent_profiles as sp')
                        ->whereColumn('sp.user_id', 'u.id');
                })
                    ->orWhereExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('stundent_profiles as sp2')
                            ->whereColumn('sp2.user_id', 'u.id')
                            ->whereNull('sp2.policyId')
                            ->whereNull('sp2.campus_id')
                            ->whereNull('sp2.prog_id')
                            ->whereNull('sp2.prereg_status');
                    });
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('results as r')
                    ->whereColumn('r.user_id', 'u.id');
            })
            ->get();

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

        //fetch the programs from thiss api
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');
        $programs = collect(); // default empty collection

        if ($response->successful()) {
            $programs = collect($response->json());
        }

        return view('admin.prereg.profile.add-profile', compact('users', 'nationalities', 'tribes', 'religions', 'programs'));
    }

    public function getUserData($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $appNo = DB::table('reservations')->where('user_id', $id)->value('app_no');
        $csa = DB::table('results')->where('user_id', $id)->value('csa');

        return response()->json([
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'birthdate' => $user->birthdate,
            'app_no' => $appNo,
            'csa' => $csa,
            'suffix' => $user->suffix,
            'email' => $user->email,
            'phone' => $user->phone,
            'sex' => $user->sex,
            'user_id' => $user->id,
        ]);
    }

    public function addProfileSave(Request $request)
    {
        $policyId = $request->policyId;
        $user_id = $request->user_id;

        //fetch the active prereg_term
        $prereg_term = PreregistrationTerm::where('status', 1)->first();
        $active_prereg_id = $prereg_term->id;

        $request->validate([
            'app_no' => [
                'required',
                Rule::unique('stundent_profiles', 'app_no')->ignore($user_id, 'user_id')
            ],
            'user_id' => [
                'required',
                Rule::unique('stundent_profiles', 'user_id')->ignore($user_id, 'user_id')
            ],
            'email' => [
                'required',
                Rule::unique('stundent_profiles', 'email')->ignore($user_id, 'user_id')
            ],
        ]);


        try {
            Log::info("Fetching program policy for user_id: {$user_id}, policy_id: {$policyId}");

            // Fetch program policy data from external API
            $programResponse = Http::get("http://172.16.0.60/academic/api/v2/ProgramPolicies/{$policyId}");

            if (!$programResponse->successful()) {
                Log::warning("API call failed for policy_id: {$policyId}, status: " . $programResponse->status());
                return redirect()->back()->with('error', 'Failed to fetch program data.');
            }

            $data = $programResponse->json();


            Log::info('Program data fetched successfully', $data);

            DB::beginTransaction();

            $profile = StundentProfile::updateOrCreate(
                ['user_id' => $user_id],
                [
                    // applicant details
                    'user_id' => $user_id,
                    'student_type' => 1,
                    'freshmen_type' => 1,
                    'app_no' => trim($request->app_no),
                    'last_name' => trim($request->last_name),
                    'first_name' => trim($request->first_name),
                    'middle_name' => trim($request->middle_name),
                    'ext_name' => trim($request->ext_name),
                    'date_of_birth' => trim($request->birthdate),
                    'gender' => trim($request->gender),
                    'mobile_no' => trim($request->mobile_no),
                    'email' => trim($request->email),
                    'prereg_term_id' => $active_prereg_id,

                    // program details
                    'policyId' => $data['id'] ?? null,
                    'campus_id' => $data['campusId'] ?? null,
                    'prog_id' => $data['programId'] ?? null,
                    'major_disc_id' => $data['majorDiscId'] ?? null,
                    'collegeId' => $data['collegeId'] ?? null,
                    'termId' => $data['termId'] ?? null,
                    'programName' => isset($data['programName']) ? trim($data['programName']) : null,
                    'collegeName' => isset($data['collegeName']) ? trim($data['collegeName']) : null,
                    'campusName' => isset($data['realCampus']) ? trim($data['realCampus']) : null,
                    'term' => isset($data['term']) ? trim($data['term']) : null,
                    'majorDiscDesc' => isset($data['majorDiscDesc']) ? trim($data['majorDiscDesc']) : null,
                    'programCode' => isset($data['programCode']) ? trim($data['programCode']) : null,
                    'realCampusId' => $data['realCampusId'] ?? null,
                    'prereg_status' => 'pending',
                    'current_step' => 6,
                    'status_id' => null,
                    'date_confirmed' => now(),
                    'added_by' => Auth::user()->id . '-' . Auth::user()->email,
                    'confirmation_batch' => 2,
                    'date_program_selected' => now(),
                ]
            );


            Log::info("Student profile updated for user_id: {$user_id}", ['profile' => $profile]);

            DB::commit();

            return redirect()->route('admin.add-applicant-profile.index')
                ->with('success', 'Student profile saved successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving program info: ' . $e->getMessage(), [
                'user_id' => $user_id,
                'program_policy_id' => $policyId,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.add-applicant-profile.index')
                ->with('error', 'Something went wrong while saving. Please check if all details are correct and complete.')
                ->with('message', $e->getMessage());
        }
    }

}
