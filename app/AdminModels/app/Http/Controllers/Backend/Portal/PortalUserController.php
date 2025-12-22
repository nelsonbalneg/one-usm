<?php

namespace App\Http\Controllers\Backend\Portal;

use App\Models\PortalUser;
use Illuminate\Http\Request;
use App\Mail\PortalAccountMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PortalUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.portal.users.index');
    }

    public function getallUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = PortalUser::select([
                'portal_users.id',
                'portal_users.student_id',
                'portal_users.firstname',
                'portal_users.lastname',
                'portal_users.middlename',
                'portal_users.suffix',
                'portal_users.email',
                'portal_users.birthdate',
                'portal_users.role',
                'portal_users.status',
                'portal_users.photo',
                'portal_users.campus_id',
                'portal_users.tenant_id',
                'portal_users.created_at',
                'terms.campus_name',
                'terms.description',
                'terms.term_name',

                // Full name (Lastname, Firstname Middlename)
                DB::raw("CONCAT(portal_users.lastname, ', ', portal_users.firstname, ' ', ISNULL(portal_users.middlename, '')) AS fullname")
            ])
                ->leftJoin('terms', function ($join) {
                    $join->on('portal_users.campus_id', '=', 'terms.real_campus_id')
                        ->on('portal_users.tenant_id', '=', 'terms.tenant_id');
                });
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-2">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md change-pass size-8 bg-slate-100 text-slate-500 hover:text-purple-500 hover:bg-purple-100 dark:bg-purple-600 dark:text-purple-200 dark:hover:bg-purple-500/20 dark:hover:text-purple-500" data-id=' . $row->id . '><i data-lucide="key-round" class="size-4"></i></a>
                          <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-yellow-500 hover:bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-200 dark:hover:bg-yellow-500/20 dark:hover:text-yellow-500" data-id=' . $row->id . '><i data-lucide="pencil" class="size-4"></i></a>


                                </div>';
                    } else {
                        return ' <div class="flex gap-2">
                                <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md change-pass size-8 bg-slate-100 text-slate-500 hover:text-purple-500 hover:bg-purple-100 dark:bg-purple-600 dark:text-purple-200 dark:hover:bg-purple-500/20 dark:hover:text-purple-500" data-id=' . $row->id . '><i data-lucide="key-round" class="size-4"></i></a>
                                <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-entry bg-slate-100 text-slate-500 hover:text-yellow-500 hover:bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-200 dark:hover:bg-yellow-500/20 dark:hover:text-yellow-500" data-id=' . $row->id . '><i data-lucide="pencil" class="size-4"></i></a>
                                <a href=' . route('admin.portal.users.destroy', ['user' => $row->id]) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 delete-entry bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-red-600 dark:text-red-200 dark:hover:bg-red-500/20 dark:hover:text-red-500"><i data-lucide="trash-2" class="size-4"></i></a>
                                </div>';
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
                ->addColumn('fullname', function ($query) {
                    $fullname = strtoupper($query->fullname);
                    $email = $query->email;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                   <h6 class="mb-1">' . $fullname . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $email . '</span>
                                 </div>
                            </div>';
                })
                ->addColumn('campus', function ($query) {
                    $description = strtoupper($query->description);
                    $campus_name = $query->campus_name;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                   <h6 class="mb-1">' . $description . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20"> ' . $campus_name . '</span>
                                 </div>
                            </div>';
                })
                ->rawColumns(['status', 'action', 'fullname', 'campus'])
                ->make(true);


        }
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
        $request->validate(
            [
                'student_id' => ['required', 'string', 'max:20', 'unique:portal_users,student_id'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:portal_users,email'],
                'birthdate' => ['required'],
            ]
        );

        // Split the campus_selector value into campus_id and tenant_id
        list($campus_id, $tenant_id) = explode('|', $request->campus_selector);

        $user = new PortalUser;
        $user->student_id = $request->student_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->campus_id = $campus_id;
        $user->tenant_id = $tenant_id;
        $user->password = bcrypt($request->student_id);
        $user->save();

        // Queue the email
        Mail::to($user->email)->queue(new PortalAccountMail($user));

        return response()->json([
            'success' => true,
            'message' => 'New User Added Successfully!',
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
        $user = PortalUser::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);

    }


    public function storePassword(Request $request)
    {
        //validate the current password
        $request->validate([
            'password' => ['required', 'min:8']
        ]);
        $user = PortalUser::findOrFail($request->userChangepassId);
        $user->password = bcrypt($request->password);
        $user->save();

        return response(['status' => 'success', 'message' => 'Password has been changed successfully!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = PortalUser::findOrFail($id);

        $request->validate(
            [
                'student_id' => ['required', 'string', 'max:20', Rule::unique('portal_users')->ignore($user->id)],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('portal_users')->ignore($user->id)],
                'birthdate' => ['required'],
            ]
        );

        // Split the campus_selector value into campus_id and tenant_id
        list($campus_id, $tenant_id) = explode('|', $request->campus_selector);

        $user->student_id = $request->student_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->role = $request->role;
        $user->campus_id = $campus_id;
        $user->tenant_id = $tenant_id;
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User Details Updated Successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = PortalUser::findOrFail($id);
        $user->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
}
