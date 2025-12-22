<?php

namespace App\Http\Controllers\Backend;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class RFCCEEScoreController extends Controller
{
    public function index()
    {
        return view('admin.result.rfc');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Result::select(
                'results.id',
                'results.app_no',
                'results.fullname',
                'results.cee_session_id',
                'results.science',
                'results.math',
                'results.humanities',
                'results.inductive',
                // 'results.abstract',
                'results.status',
                'results.csa',
                'results.ispending_edit',
                'results.remarks',
                'results.created_at',
                'results.updated_at',
                'cee_sessions.status AS ceesesstatus',
                DB::raw('(SELECT COUNT(*) FROM results r2 WHERE r2.app_no = results.app_no) AS duplicate_count')
            )
                ->leftJoin('cee_sessions', 'results.cee_session_id', '=', 'cee_sessions.id')
                ->where('results.ispending_edit', '=', 'yes');
                // ->where('cee_sessions.status', '=', 'active');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return ' <div class="flex gap-3">
                        <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-details size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="info" class="inline-block size-3"></i> </a>
                        <a  href=' . route('admin.cee.result-rfc.approve', $row->id) . ' class="flex items-center justify-center text-white transition-all duration-200 ease-linear bg-green-500 rounded-md approve-rfc size-8 hover:text-green-900 hover:bg-green-400 dark:bg-green-600 dark:text-green-300 dark:hover:bg-green-700 dark:hover:text-green-500">
                            <i data-lucide="check" class="inline-block size-3"></i>
                        </a>

                    </div>';
                })
                ->filter(function ($query) use ($request) {
                    // $query->where('cee_sessions.status', '=', 'active'); // Always enforce this condition

                    if ($request->has('search')) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('results.app_no', 'like', "%{$searchValue}%")
                                ->orWhere('results.fullname', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->editColumn('app_no', function ($row) {
                    return $row->duplicate_count > 1
                        ? '<span class="font-bold text-red-500">' . $row->app_no . '</span>'
                        : $row->app_no;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '' || empty($row->status)) {
                    } else if ($row->status == 'saved') {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20"><i data-lucide="layers" class="inline-block size-3"></i> Saved</span>';
                    } else if ($row->status == 'posted') {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20"><i data-lucide="check" class="inline-block size-3"></i> Posted</span>';
                    } else if ($row->status == 'pending') {
                        return '<span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20"><i data-lucide="circle-dot-dashed" class="inline-block size-3"></i> Pending</span>';
                    }
                })
                ->addColumn('ispending_edit', function ($row) {
                    if ($row->ispending_edit == '' || empty($row->status)) {
                    } else if ($row->ispending_edit == 'yes') {
                        return '  <span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-slate-100 border-slate-200 text-slate-500 dark:bg-slate-500/20 dark:border-slate-500/20 dark:text-zink-200"><i data-lucide="loader" class="inline-block size-3"></i> Waiting for Approval</span>';
                    } else if ($row->ispending_edit == 'approved') {
                        return ' <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">Approved</span>';
                    }
                })
                ->rawColumns(['action', 'app_no', 'ispending_edit', 'status'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function viewdetails(string $id)
    {
        $ceeresult = Result::findOrFail($id);
        return response()->json([
            'ceeresult' => $ceeresult
        ]);
    }

    //approverfc

    public function approverfc(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password is incorrect.'
            ]);
        }

        // Update the result status to "saved"
        $result = Result::find($request->result_id);
        if ($result) {
            $result->status = 'posted';
            $result->ispending_edit = 'approved';
            $result->updated_at = now();

            $result->save();

            return response()->json([
                'success' => true,
                'message' => 'Result status updated to posted.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Result not found.'
        ]);
    }
}
