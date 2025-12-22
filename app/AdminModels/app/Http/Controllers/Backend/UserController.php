<?php

namespace App\Http\Controllers\Backend;

use App\Models\UsersAssignedAcademicStatus;
use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SchoolName;
use App\Models\Reservation;
use Illuminate\Http\Request;

use App\Trait\ImageUploadTrait;
use Illuminate\Validation\Rule;
use App\Mail\AccountDetailsEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ChedApplicantProfile;
use App\Models\UsersAssignedProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ImageUploadTrait;
    public function index()
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        $programs = [];
        if ($response->successful()) {
            $programs = $response->json();
        }

        // Retrieve the selected program IDs for the logged-in user
        $userId = auth()->id();
        $selectedPrograms = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        return view("admin.users.index", compact('programs', 'selectedPrograms'));
    }




    public function getallUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'users.id',
                'users.firstname',
                'users.lrn',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'users.email',
                'users.phone',
                'users.status',
                'users.role',
                'users.photo',
                'users.created_at',
                'ched_applicant_profiles.status as ched_profile_status',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS fullname")
            ])
                ->leftJoin('ched_applicant_profiles', 'users.id', '=', 'ched_applicant_profiles.user_id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {

                        if ($row->role == 'pao' || $row->role == 'aro' || $row->role == 'dean') {
                            $uniqueId = 'dropdown-' . $row->id;
                            $encrypteduserid = Crypt::encryptString($row->id);
                            return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>


                                    <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user-tagging.index', ['id' => $row->id]) . '">
                                            <i data-lucide="tag" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Admin User Tagging</span>
                                         </a>
                                    </li>

                                      <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user-tagging.index', ['id' => $row->id]) . '">
                                            <i data-lucide="group" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Assign Office</span>
                                         </a>
                                    </li>

                                      <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';
                        } else {
                            $uniqueId = 'dropdown-' . $row->id;
                            $encrypteduserid = Crypt::encryptString($row->id);
                            return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.cee.ched-profile.index', ['id' => $encrypteduserid]) . '">
                                            <i data-lucide="school" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">CHED Profile</span>
                                         </a>
                                    </li>

                                      <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                               href=' . route('admin.user.detailed-info.index', ['id' => $row->id]) . '>
                                            <i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Details</span>
                                        </a>
                                    </li>

                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>
                                      <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.reservation.history.index', ['id' => $encrypteduserid]) . '">
                                            <i data-lucide="layout-list" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">History</span>
                                         </a>
                                    </li>
                                    <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.reservation-history.index', ['id' => $encrypteduserid]) . '">
                                            <i data-lucide="calendar-check-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Reservation</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';
                        }

                    }
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })
                ->addColumn('ched_profile_status', function ($row) {
                    $id = $row->id;
                    $switchId = 'greenDefaultSwitch_' . $id;

                    if (is_null($row->ched_profile_status)) {
                        // No toggle, just a disabled red icon
                        return '<a href="#!" class="flex items-center justify-center text-red-500 transition-all duration-200 ease-linear bg-red-100 rounded size-9 hover:bg-red-200 dark:bg-red-500/20 dark:hover:bg-red-500/30">
                                    <i data-lucide="x" class="size-4"></i>
                                </a>';
                    }

                    $isChecked = $row->ched_profile_status == 1 ? 'checked' : '';

                    return '<div class="flex">
                                <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                    <input type="checkbox"
                                           data-id="' . $id . '"
                                           name="greenDefaultSwitch"
                                           id="' . $switchId . '"
                                           class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-type size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none"
                                           ' . $isChecked . '>
                                    <label for="' . $switchId . '"
                                           class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                                </div>
                            </div>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where('users.firstname', 'like', "%{$searchValue}%")
                            ->orWhere('users.lastname', 'like', "%{$searchValue}%")
                            ->orWhere('users.lrn', 'like', "%{$searchValue}%")
                            ->orWhere('users.email', 'like', "%{$searchValue}%");
                    }
                })
                ->rawColumns(['status', 'name', 'action', 'ched_profile_status'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
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
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->suffix = $request->suffix;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Cache::forget('users_data_page_1');

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'New user added successfully!',
        ]);
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
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateData(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate(
            [
                // 'lrn' => ['required', 'size:12'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:15'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            ],
            [
                'lrn.size' => 'The LRN must be exactly 12 digits.'
            ]
        );
        $user->employee_id = $request->employee_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->birthdate = $request->birthdate;
        $user->role = $request->role;
        $user->lrn = $request->lrn;
        $user->street = $request->street;
        $user->save();

        Cache::forget('users_data_page_1');

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'User Data updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->deleteImage($user->photo);

        Reservation::where('user_id', $id)->delete();
        $user->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changePassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);
    }

    //update password
    public function storePassword(Request $request)
    {
        //validate the current password
        $request->validate([
            'password' => ['required', 'min:8']
        ]);
        $user = User::findOrFail($request->userChangepassId);
        $user->password = bcrypt($request->password);
        $user->save();

        return response(['status' => 'success', 'message' => 'Password has been changed successfully!']);
    }

    public function detailedInfo(Request $request, $id)
    {

        $studentdetails = User::findOrFail($id);
        // Ensure empty strings for NULL values to avoid issues in JavaScript
        $studentdetails->region = $studentdetails->region ?? '';
        $studentdetails->province = $studentdetails->province ?? '';
        $studentdetails->city = $studentdetails->city ?? '';
        $studentdetails->brgy = $studentdetails->brgy ?? '';

        return view("admin.profile.profile", compact('studentdetails'));
    }

    public function uploadPhoto(Request $request)
    {
        // validation
        $request->validate(
            [
                'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:5120'],

            ]
        );

        $user = User::findOrFail($request->id);

        // Handle photo upload
        $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return redirect()->back()->with('message', 'Your Profile Photo has been updated!');
    }

    public function update(Request $request, string $id)
    {

        // validation
        if (
            $request->apptype == 'transferee' ||
            $request->apptype == 'second_courser' ||
            $request->apptype == 'hs_grad' ||
            $request->apptype == 'shiftee'
        ) {
            $request->validate(
                [
                    Rule::unique('users', 'lrn')->ignore($id),
                    'track' => ['required', 'string', 'max:100'],
                    'school_id' => ['required'],
                    'school_name' => ['required'],
                    'school_address' => ['required'],
                    'region_text' => ['required'],
                    'province_text' => ['required'],
                    'city_text' => ['required'],
                    'barangay_text' => ['required'],
                    'apptype' => ['required']

                ],
                [
                    'lrn.size' => 'The LRN must be exactly 12 digits.',
                    'apptype.required' => 'Please select an applicant type.',
                ]
            );
        } else {
            $request->validate(
                [
                    'lrn' => [
                        'required',
                        'size:12',
                        Rule::unique('users', 'lrn')->ignore($id),
                    ],
                    'track' => ['required', 'string', 'max:100'],
                    'school_id' => ['required'],
                    'school_name' => ['required'],
                    'school_address' => ['required'],
                    'region_text' => ['required'],
                    'province_text' => ['required'],
                    'city_text' => ['required'],
                    'barangay_text' => ['required'],

                ],
                [
                    'lrn.size' => 'The LRN must be exactly 12 digits.',
                    'lrn.unique' => 'The LRN has already been taken.'
                ]
            );
        }


        $user = User::findOrFail($id);

        $user->lrn = trim($request->lrn);
        $user->track = trim($request->track);
        $user->schoolid = trim($request->school_id);
        $user->shs_school = trim($request->school_name);
        $user->school_address = trim($request->school_address);
        $user->region = trim($request->region_text);
        $user->province = trim($request->province_text);
        $user->city = trim($request->city_text);
        $user->brgy = trim($request->barangay_text);
        $user->street = trim($request->street);
        $user->zipcode = trim($request->zipcode);
        $user->applicant_type = trim($request->apptype);

        // // Handle photo upload
        // $imagePath = $this->updateImage($request, 'photo', 'uploads', $user->photo);
        // $user->photo = empty(!$imagePath) ? $imagePath : $user->photo;

        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Profile Information has been successfully updated!']);
    }

    public function school_name(Request $request)
    {
        // Check if 'schoolid' is provided in the request
        if ($request->has('schoolid')) {
            // Fetch records where 'schoolid' matches the provided value
            $schools = SchoolName::where('schoolid', $request->input('schoolid'))->get();
        } else {
            // Fetch all records if 'schoolid' is not provided
            $schools = SchoolName::all();
        }

        // Return the results in JSON format
        return response()->json($schools);
    }

    public function addUser(Request $request)
    {
        $request->validate(
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:15', 'unique:users,phone'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'birthdate' => ['required'],
                'sex' => ['required']
            ]
        );

        $user = new User;
        $user->employee_id = $request->employee_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->birthdate = $request->birthdate;
        $user->role = $request->role;
        $user->password = bcrypt($request->phone);
        $user->save();

        //Send welcome email
        Mail::to($user->email)->queue(new AccountDetailsEmail($user));

        return response()->json([
            'success' => true,
            'message' => 'New User Added Successfully!',
        ]);
    }

    public function userreservationHistoryindex(Request $request)
    {
        $userid = Crypt::decryptString($request->id);
        $user = User::findOrFail($userid);
        return view('admin.users.reservation-history', compact('user'));
    }

    public function userreservationhistorygetData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('reservations')
                ->leftJoin('rooms', 'reservations.room_id', '=', 'rooms.id') //cee_session_id  cee_sessions
                ->leftJoin('users', 'reservations.user_id', '=', 'users.id')
                ->leftJoin('booklet_numbers', 'reservations.user_id', '=', 'booklet_numbers.user_id')
                ->leftJoin('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->select(
                    'reservations.user_id',
                    'reservations.app_no',
                    'reservations.id',
                    'reservations.firstpriorty_desc',
                    'reservations.secondpriority_desc',
                    'reservations.thirdpriorty_desc',
                    'reservations.campus_id',
                    'reservations.campus_id_prio_prog_2',
                    'reservations.campus_id_prio_prog_3',
                    'reservations.is_repeat_exam',
                    'reservations.created_at',
                    'reservations.cee_session_id',
                    'reservations.status',
                    'rooms.room_name',
                    'rooms.college_name',
                    'rooms.capacity',
                    'rooms.exam_session',
                    'rooms.campus',
                    'rooms.time',
                    'rooms.schedule',
                    'rooms.exam_session',
                    'users.firstname',
                    'users.lastname',
                    'users.email',
                    'users.sex',
                    'users.phone',
                    'users.birthdate',
                    'users.suffix',
                    'booklet_numbers.bookletNo',
                    'cee_sessions.id AS sessionId',
                    DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, ''), ' ', ISNULL(users.suffix, '')) AS fullname")
                )
                ->when($request->user_id, function ($query) use ($request) {
                    return $query->where('reservations.user_id', $request->user_id);
                });
            // ->where('cee_sessions.status', 'active');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $encryptedAppNo = Crypt::encryptString($row->app_no);
                    $encryptedreid = Crypt::encryptString($row->id);

                    return
                        '<div class="flex gap-3">
                            <a href=' . route('admin.cee.exam-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                            <a href=' . route('admin.cee.send.exam-slip', ['app_no' => $row->app_no]) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md send-email size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="mail" class="size-4"></i></a>
                            <a href=' . route('admin.reservation.reservation.edit', ['id' => $encryptedreid]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-yellow-500 hover:bg-yellow-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pen" class="inline-block size-3"></i> </a>
                            <a href=' . route('admin.reservation.destroy', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-reservation size-8 bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                    </div>';

                })
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.firstname, ' ', users.lastname, ' ', ISNULL(users.suffix, '')) like ?", ["%{$keyword}%"])
                        ->orWhere('users.email', 'like', "%{$keyword}%")
                        ->orWhere('reservations.app_no', 'like', "%{$keyword}%");
                })
                ->addColumn('sessionId', function ($row) {
                    return $row->sessionId;
                })
                ->addColumn('bookletNo', function ($row) {

                    if ($row->bookletNo == null) {
                        return '<div class="flex gap-3">
                                    <a data-id=' . $row->user_id . '
                                    data-session-id=' . $row->cee_session_id . '
                                    data-app-no=' . $row->app_no . '
                                    class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md add_booklet_no size-8 bg-slate-100 text-slate-500 hover:text-green-500 hover:bg-green-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500">
                                    <i data-lucide="plus" class="size-4"></i>
                                    </a>
                                </div>';
                    } else {
                        return $row->bookletNo;
                    }
                })
                ->addColumn('is_repeat_exam', function ($query) {
                    if ($query->is_repeat_exam == 'Yes') {
                        return ' <div class="flex items-center">
                        <div class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                            <input type="checkbox"  data-id=' . $query->id . ' name="greenDefaultSwitch" id="greenDefaultSwitch" class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-type size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none" checked>
                            <label for="greenDefaultSwitch" class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                        </div>
                    </div>';

                    } else {
                        return ' <div class="flex items-center">
                        <div class="relative inline-block w-10 align-middle transition duration-200 ease-in ltr:mr-2 rtl:ml-2">
                            <input type="checkbox" data-id=' . $query->id . ' name="greenDefaultSwitch" id="greenDefaultSwitch" class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-type size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none">
                            <label for="greenDefaultSwitch" class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer cursor-pointertransition border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                        </div>
                    </div>';
                    }
                })
                ->addColumn('college_name', function ($query) {
                    $room = $query->room_name;
                    $batch = $query->exam_session;
                    $schedule = $query->schedule ? Carbon::parse($query->schedule)->format('F j, Y') : 'N/A';
                    $time = $query->time;
                    $building = $query->college_name;
                    $cee_term = $query->cee_session_id;

                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                 <h6 class="mb-1"><a href="#!" class="name">' . $query->campus . '</a></h6>
                                    <h6 class="mb-1"><a href="#!" class="name">' . $building . ' - ' . $room . '</a></h6>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">' . $cee_term . ' - ' . $batch . '</span>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">' . $schedule . ' ( ' . $time . ' )</span>
                                 </div>
                            </div>';
                })
                ->addColumn('fullname', function ($query) {
                    $app_no = $query->app_no;
                    $fullname = strtoupper($query->fullname);
                    $email = $query->email;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                 <h6 class="mb-1">' . $app_no . '</h6>
                                   <h6 class="mb-1">' . $fullname . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $email . '</span>
                                 </div>
                            </div>';
                })
                ->addColumn('status', function ($query) {

                    $status_msg = '';
                    if ($query->status == 'pending') {
                        $status_msg = ' <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">Pending</span>';
                    } else if ($query->status == 'cancelled') {
                        $status_msg = '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Cancelled</span>';
                    } else {
                        $status_msg = '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">Confirmed</span>';
                    }

                    return $status_msg;
                })
                ->rawColumns(['status', 'fullname', 'action', 'college_name', 'sessionId', 'is_repeat_exam', 'bookletNo'])
                ->make(true);
        }
    }

    public function updateStatus(Request $request)
    {
        $user = ChedApplicantProfile::where('user_id', $request->id)->first();

        if (!$user) {
            return response()->json(['message' => 'User profile not found'], 404);
        }

        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'CHED Profile status updated successfully!']);
    }

    public function programPolicy()
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        if ($response->successful()) {
            $programs = $response->json();
            return view('admin.users.index', compact('programs'));
        } else {
            return back()->withErrors('Failed to fetch programs');
        }
    }

    public function storeUserAssignedProgram(Request $request)
    {
        $userId = $request->input('user_assigned_id');
        $policyIds = $request->input('choices-multiple-default'); // Array of selected program IDs

        // Ensure the user is logged in
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Check if selected programs are provided
        if (!$policyIds || !is_array($policyIds)) {
            return response()->json(['error' => 'No programs selected'], 400);
        }

        // Get the current assigned programs for the logged-in user
        $currentAssignedPrograms = UsersAssignedProgram::where('user_id', $userId)->pluck('policyId')->toArray();

        // Programs to be added (in the new list but not in the current list)
        $programsToAdd = array_diff($policyIds, $currentAssignedPrograms);

        // Programs to be removed (in the current list but not in the new list)
        $programsToRemove = array_diff($currentAssignedPrograms, $policyIds);

        // Add new programs
        foreach ($programsToAdd as $programId) {
            UsersAssignedProgram::create([
                'user_id' => $userId,
                'policyId' => $programId,
            ]);
        }

        // Remove programs that were deselected
        foreach ($programsToRemove as $programId) {
            UsersAssignedProgram::where('user_id', $userId)
                ->where('policyId', $programId)
                ->delete();
        }

        return response()->json([
            'message' => 'Programs updated successfully!',
        ]);
    }

    //admin index
    public function adminUserIndex()
    {
        return view('admin.users.admin-user');
    }

    //fetch admin users
    public function getAdminUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'users.id',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'users.email',
                'users.phone',
                'users.status',
                'users.role',
                'users.photo',
                'users.created_at',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS fullname")
            ])
                ->where('users.role', 'like', 'admin');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {

                        $uniqueId = 'dropdown-' . $row->id;
                        $encrypteduserid = Crypt::encryptString($row->id);
                        return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>
                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>
                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';

                    }
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })
                ->filter(function ($query) use ($request) {
                    $query->where('users.role', 'admin'); // ensure role filter is enforced

                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($q) use ($searchValue) {
                            $q->where('users.firstname', 'like', "%{$searchValue}%")
                                ->orWhere('users.lastname', 'like', "%{$searchValue}%")
                                ->orWhere('users.lrn', 'like', "%{$searchValue}%")
                                ->orWhere('users.email', 'like', "%{$searchValue}%");
                        });
                    }
                })

                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }


    //Pao index
    public function paoUserIndex()
    {
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        $programs = [];
        if ($response->successful()) {
            $programs = $response->json();
        }

        // Retrieve the selected program IDs for the logged-in user
        $userId = auth()->id();
        $selectedPrograms = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        return view("admin.users.pao-user", compact('programs', 'selectedPrograms'));
    }

    //fetch Pao users
    public function getPaoUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'users.id',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'users.email',
                'users.phone',
                'users.status',
                'users.role',
                'users.photo',
                'users.created_at',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS fullname")
            ])
                ->where('users.role', 'pao')
                ->when($request->has('search') && $request->get('search')['value'], function ($query) use ($request) {
                    $searchValue = $request->get('search')['value'];
                    $query->where(function ($q) use ($searchValue) {
                        $q->where('users.firstname', 'like', "%{$searchValue}%")
                            ->orWhere('users.lastname', 'like', "%{$searchValue}%")
                            ->orWhere('users.email', 'like', "%{$searchValue}%")
                            ->orWhere('users.lrn', 'like', "%{$searchValue}%");
                    });
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {

                        $uniqueId = 'dropdown-' . $row->id;
                        $encrypteduserid = Crypt::encryptString($row->id);
                        return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>

                                        <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user-tagging.index', ['id' => $row->id]) . '">
                                            <i data-lucide="tag" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Admin User Tagging</span>
                                         </a>
                                    </li>
                                      <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';

                    }
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })

                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }

    //ARO index
    public function aroUserIndex()
    {

        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        $programs = [];
        if ($response->successful()) {
            $programs = $response->json();
        }

        // Retrieve the selected program IDs for the logged-in user
        $userId = auth()->id();
        $selectedPrograms = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        return view("admin.users.aro-user", compact('programs', 'selectedPrograms'));
    }

    //fetch ARO users
    public function getAroUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'users.id',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'users.email',
                'users.phone',
                'users.status',
                'users.role',
                'users.photo',
                'users.created_at',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS fullname")
            ])
                ->where('users.role', 'aro')
                ->when($request->has('search') && $request->get('search')['value'], function ($query) use ($request) {
                    $searchValue = $request->get('search')['value'];
                    $query->where(function ($q) use ($searchValue) {
                        $q->where('users.firstname', 'like', "%{$searchValue}%")
                            ->orWhere('users.lastname', 'like', "%{$searchValue}%")
                            ->orWhere('users.email', 'like', "%{$searchValue}%")
                            ->orWhere('users.lrn', 'like', "%{$searchValue}%");
                    });
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {

                        $uniqueId = 'dropdown-' . $row->id;
                        $encrypteduserid = Crypt::encryptString($row->id);
                        return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>

                                       <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user-tagging.index', ['id' => $row->id]) . '">
                                            <i data-lucide="tag" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Admin User Tagging</span>
                                         </a>
                                    </li>

                                      <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';

                    }
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })

                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }


    //dean index
    public function deanUserIndex()
    {

        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        $programs = [];
        if ($response->successful()) {
            $programs = $response->json();
        }

        // Retrieve the selected program IDs for the logged-in user
        $userId = auth()->id();
        $selectedPrograms = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        return view("admin.users.dean-user", compact('programs', 'selectedPrograms'));
    }

    //fetch dean users
    public function getDeanUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'users.id',
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'users.email',
                'users.phone',
                'users.status',
                'users.role',
                'users.photo',
                'users.created_at',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS fullname")
            ])
                ->where('users.role', 'dean')
                ->when($request->has('search') && $request->get('search')['value'], function ($query) use ($request) {
                    $searchValue = $request->get('search')['value'];
                    $query->where(function ($q) use ($searchValue) {
                        $q->where('users.firstname', 'like', "%{$searchValue}%")
                            ->orWhere('users.lastname', 'like', "%{$searchValue}%")
                            ->orWhere('users.email', 'like', "%{$searchValue}%")
                            ->orWhere('users.lrn', 'like', "%{$searchValue}%");
                    });
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {

                        $uniqueId = 'dropdown-' . $row->id;
                        $encrypteduserid = Crypt::encryptString($row->id);
                        return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>

                                         <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user-tagging.index', ['id' => $row->id]) . '">
                                            <i data-lucide="tag" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Admin User Tagging</span>
                                         </a>
                                    </li>
                                      <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';

                    }
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })

                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }

    //dean index
    public function applicantUserIndex()
    {
        return view('admin.users.cee-applicant-user');
    }

    //fetch dean users
    public function getApplicantUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'users.id',
                'users.firstname',
                'users.lrn',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'users.email',
                'users.phone',
                'users.status',
                'users.role',
                'users.photo',
                'users.created_at',
                'ched_applicant_profiles.status as ched_profile_status',
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS fullname")
            ])
                ->leftJoin('ched_applicant_profiles', 'users.id', '=', 'ched_applicant_profiles.user_id')
                ->where('users.role', 'student')
                ->when($request->has('search') && $request->get('search')['value'], function ($query) use ($request) {
                    $searchValue = $request->get('search')['value'];
                    $query->where(function ($q) use ($searchValue) {
                        $q->where('users.firstname', 'like', "%{$searchValue}%")
                            ->orWhere('users.lastname', 'like', "%{$searchValue}%")
                            ->orWhere('users.email', 'like', "%{$searchValue}%")
                            ->orWhere('users.lrn', 'like', "%{$searchValue}%");
                    });
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {

                        $uniqueId = 'dropdown-' . $row->id;
                        $encrypteduserid = Crypt::encryptString($row->id);
                        return '
                            <div class="relative dropdown">
                                <button
                                    id="' . $uniqueId . '-button"
                                    class="flex items-center justify-center p-2 rounded dropdown-toggle bg-slate-100 hover:bg-slate-600 focus:bg-slate-600 text-slate-500 hover:text-white focus:text-white"
                                    type="button">
                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                </button>
                                <ul
                                    id="' . $uniqueId . '-menu"
                                    class="absolute right-0 z-50 hidden w-48 py-2 mt-1 bg-white rounded-md shadow-md dropdown-menu dark:bg-gray-800">

                                    <li>
                                         <a class="change-pass block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="key-round" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Change Password</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.cee.ched-profile.index', ['id' => $encrypteduserid]) . '">
                                            <i data-lucide="school" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">CHED Profile</span>
                                         </a>
                                    </li>

                                      <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                               href=' . route('admin.user.detailed-info.index', ['id' => $row->id]) . '>
                                            <i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Details</span>
                                        </a>
                                    </li>

                                    <li>
                                         <a class="edit-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            data-id=' . $row->id . '>
                                            <i data-lucide="pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Edit</span>
                                         </a>
                                    </li>
                                      <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.reservation.history.index', ['id' => $encrypteduserid]) . '">
                                            <i data-lucide="layout-list" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">History</span>
                                         </a>
                                    </li>
                                    <li>
                                         <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.reservation-history.index', ['id' => $encrypteduserid]) . '">
                                            <i data-lucide="calendar-check-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Reservation</span>
                                         </a>
                                    </li>

                                     <li>
                                         <a class="delete-entry block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="' . route('admin.user.destroy', $row->id) . '">
                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                            <span class="align-middle">Delete</span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        ';

                    }
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })
                ->addColumn('ched_profile_status', function ($row) {
                    $id = $row->id;
                    $switchId = 'greenDefaultSwitch_' . $id;

                    if (is_null($row->ched_profile_status)) {
                        // No toggle, just a disabled red icon
                        return '<a href="#!" class="flex items-center justify-center text-red-500 transition-all duration-200 ease-linear bg-red-100 rounded size-9 hover:bg-red-200 dark:bg-red-500/20 dark:hover:bg-red-500/30">
                                    <i data-lucide="x" class="size-4"></i>
                                </a>';
                    }

                    $isChecked = $row->ched_profile_status == 1 ? 'checked' : '';

                    return '<div class="flex">
                                <div class="relative inline-block w-10 align-middle transition duration-200 ease-in">
                                    <input type="checkbox"
                                           data-id="' . $id . '"
                                           name="greenDefaultSwitch"
                                           id="' . $switchId . '"
                                           class="absolute block transition duration-300 ease-linear border-2 rounded-full appearance-none cursor-pointer change-type size-5 border-slate-200 dark:border-zink-500 bg-white/80 dark:bg-zink-400 peer/published checked:bg-white dark:checked:bg-white ltr:checked:right-0 rtl:checked:left-0 checked:bg-none checked:border-green-500 dark:checked:border-green-500 arrow-none"
                                           ' . $isChecked . '>
                                    <label for="' . $switchId . '"
                                           class="block h-5 overflow-hidden duration-300 ease-linear border rounded-full cursor-pointer border-slate-200 dark:border-zink-500 bg-slate-200 dark:bg-zink-600 peer-checked/published:bg-green-500 peer-checked/published:border-green-500"></label>
                                </div>
                            </div>';
                })
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['status', 'name', 'action', 'ched_profile_status'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function UserTagging($id)
    {
        // Fetch user
        $user = User::findOrFail($id); // Throws 404 if not found

        // Optional: Construct full name (you can customize this logic)
        $userFullname = trim("{$user->lastname}, {$user->firstname} {$user->middlename} {$user->suffix}");
        $role = $user->role;

        // Fetch programs from external API
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');
        $programs = $response->successful() ? $response->json() : [];

        // Get policyIds the user is tagged to
        $userTaggedPolicyIds = UsersAssignedProgram::where('user_id', $id)->pluck('policyId')->toArray();

        return view('admin.tagging.index', compact('id', 'programs', 'userTaggedPolicyIds', 'userFullname', 'role', 'user'));
    }

    public function RemoveProgramTag(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'policy_id' => 'required|integer',
        ]);

        UsersAssignedProgram::where('user_id', $request->user_id)
            ->where('policyId', $request->policy_id)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Program tag removed successfully.']);
    }

    public function AddProgramTag(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'policy_id' => 'required|integer',
            'campus_id' => 'nullable|integer',
            'college_id' => 'nullable|integer',
            'program_id' => 'nullable|integer',
            'major_disc_id' => 'nullable|integer',
        ]);

        // Check if already exists to avoid duplicate
        $exists = UsersAssignedProgram::where('user_id', $request->user_id)
            ->where('policyId', $request->policy_id)
            ->exists();

        if (!$exists) {
            UsersAssignedProgram::create([
                'user_id' => $request->user_id,
                'policyId' => $request->policy_id,
                'campus_id' => $request->campus_id,
                'college_id' => $request->college_id,
                'program_id' => $request->program_id,
                'major_disc_id' => $request->major_disc_id,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Program tagged successfully.']);
    }

    public function AddAllProgramTag(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        // 1. Call external API
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch programs from API'
            ], 500);
        }

        $programs = $response->json();

        // 2. Loop through API data
        foreach ($programs as $program) {

            $policyId = $program['id']; // IMPORTANT: policy_id = API id

            // 3. Skip if already exists
            $exists = UsersAssignedProgram::where('user_id', $request->user_id)
                ->where('policyId', $policyId)
                ->exists();

            if ($exists) {
                continue;
            }

            // 4. Insert
            UsersAssignedProgram::create([
                'user_id' => $request->user_id,
                'policyId' => $policyId,
                'campus_id' => $program['campusId'] ?? null,
                'college_id' => $program['collegeId'] ?? null,
                'program_id' => $program['programId'] ?? null,
                'major_disc_id' => $program['majorDiscId'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'All programs tagged successfully.'
        ]);
    }

    public function RemoveAllProgramTag(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        UsersAssignedProgram::where('user_id', $request->user_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'All programs removed successfully.'
        ]);
    }

    public function CheckAllProgramTag($userId)
    {
        // 1. Get all programs from API
        $response = Http::get('http://172.16.0.60/academic/api/v2/CeeV/get-list-of-programs');

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch programs from API'
            ], 500);
        }

        $programs = $response->json();

        $allPolicyIds = collect($programs)->pluck('id')->toArray();

        // 2. Get user's assigned programs
        $userPolicyIds = UsersAssignedProgram::where('user_id', $userId)
            ->pluck('policyId')
            ->toArray();

        // 3. Check if all are tagged
        $isAllTagged = empty(array_diff($allPolicyIds, $userPolicyIds));

        return response()->json([
            'success' => true,
            'isAllTagged' => $isAllTagged
        ]);
    }

    public function ToggleAcademicStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|boolean',
        ]);

        $record = UsersAssignedAcademicStatus::updateOrCreate(
            ['user_id' => $request->user_id],
            ['status' => $request->status]
        );

        return response()->json([
            'message' => 'Status updated successfully.',
            'data' => $record
        ]);
    }

}
