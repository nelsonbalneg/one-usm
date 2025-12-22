<?php

namespace App\Http\Controllers\Backend\Portal;

use App\Models\PortalUser;
use Illuminate\Http\Request;
use App\Models\EvaluationRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class EvaluationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.portal.evaluation-request.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getallData(Request $request)
    {
        if ($request->ajax()) {
            $data = EvaluationRequest::select([
                'evaluation_requests.id',
                'evaluation_requests.request_id',
                'evaluation_requests.status',
                'evaluation_requests.remarks',
                'evaluation_requests.student_id',
                'evaluation_requests.created_at',
                'evaluation_requests.updated_at',
                DB::raw("CONCAT(portal_users.lastname, ', ', portal_users.firstname, ' ', ISNULL(portal_users.middlename, '')) AS fullname"),
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) AS evaluated_by_fullname"),
                'portal_users.email'
            ])
                ->leftJoin('portal_users', 'portal_users.student_id', '=', 'evaluation_requests.student_id')
                ->leftJoin('users', 'users.id', '=', 'evaluation_requests.evaluated_by');

            return datatables()->of($data)
                ->addIndexColumn()
                ->filterColumn('fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(portal_users.firstname, ' ', portal_users.lastname, ' ', ISNULL(portal_users.suffix, '')) like ?", ["%{$keyword}%"])
                        ->orWhere('evaluation_requests.request_id', 'like', "%{$keyword}%")
                        ->orWhere('evaluation_requests.student_id', 'like', "%{$keyword}%")
                        ->orWhere('evaluation_requests.status', 'like', "%{$keyword}%");
                })
                ->filterColumn('evaluated_by_fullname', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, '')) LIKE ?", ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($row) {
                    return ' <div class="flex gap-2">
                                <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md change-pass size-8 bg-slate-100 text-slate-500 hover:text-purple-500 hover:bg-purple-100 dark:bg-purple-600 dark:text-purple-200 dark:hover:bg-purple-500/20 dark:hover:text-purple-500" data-id=' . $row->id . '><i data-lucide="info" class="size-4"></i></a>
                                <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-entry bg-slate-100 text-slate-500 hover:text-yellow-500 hover:bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-200 dark:hover:bg-yellow-500/20 dark:hover:text-yellow-500" data-id=' . $row->id . '><i data-lucide="pencil" class="size-4"></i></a>
                                <a href=' . route('admin.portal.evaluation-requests.destroy', ['evaluation_request' => $row->id]) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 delete-entry bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-red-600 dark:text-red-200 dark:hover:bg-red-500/20 dark:hover:text-red-500"><i data-lucide="trash-2" class="size-4"></i></a>
                                </div>';
                })
                ->addColumn('fullname', function ($query) {
                    $fullname = strtoupper($query->fullname);
                    $email = $query->email;
                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                   <h6 class="mb-1">' . $fullname . '</h6>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"> ' . $email . '</span>
                                 <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20"> ' . $query->student_id . '</span>
                                 </div>
                            </div>';
                })
                ->addColumn('status', function ($query) {
                    if ($query->status == 'Evaluated') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Evaluated</span>';
                    } else if ($query->status == 'Pending') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:text-yellow-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i>Pending</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Cancelled</span>';
                    }
                    return $button;
                })
                ->rawColumns(['fullname', 'action', 'status'])
                ->make(true);
        }

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        try {
            $evaluationRequest = EvaluationRequest::findOrFail($id);

            $student = PortalUser::select('lastname', 'firstname', 'middlename', 'email')
                ->where('student_id', $evaluationRequest->student_id)
                ->firstOrFail();
            $fullName = trim("{$student->lastname} {$student->firstname} {$student->middlename}");

            return response()->json([
                'success' => true,
                'evaluation_request' => $evaluationRequest,
                'student_name' => $fullName,
                'student_email' => $student->email,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $eval_request = EvaluationRequest::findOrFail($id);

        $eval_request->remarks = $request->remarks;
        $eval_request->status = $request->status;
        $eval_request->evaluated_by = Auth::user()->id;
        $eval_request->save();

        return response()->json([
            'success' => true,
            'message' => 'Evaluation Request Details Updated Successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = EvaluationRequest::findOrFail($id);
        $user->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
}
