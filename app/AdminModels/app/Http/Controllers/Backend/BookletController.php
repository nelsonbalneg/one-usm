<?php

namespace App\Http\Controllers\Backend;

use App\Models\CeeSession;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\BookletNumber;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookletController extends Controller
{
    public function index()
    {
        $ceeActiveSession = CeeSession::where('status', 'active')->first();

        return view('admin.booklet.index', compact('ceeActiveSession'));
    }

    public function fetchAppNumbers(Request $request)
    {
        $search = $request->input('search', '');

        // Get all app_no values from booklet_numbers table
        $excludedAppNumbers = BookletNumber::pluck('app_no')->toArray();

        $appNumbers = Reservation::with('applicant')
            ->whereHas('ceeSession', function ($query) {
                $query->where('status', 'active');
            })
            ->where(function ($query) use ($search) {
                $query->where('app_no', 'like', "%$search%")
                    ->orWhereHas('applicant', function ($q) use ($search) {
                        $q->where('firstname', 'like', "%$search%")
                            ->orWhere('lastname', 'like', "%$search%");
                    });
            })
            // Exclude app_no values present in booklet_numbers table
            ->whereNotIn('app_no', $excludedAppNumbers)
            ->get()
            ->map(function ($reservation) {
                return [
                    'app_no' => $reservation->app_no,
                    'fullname' => trim("{$reservation->applicant->lastname}, {$reservation->applicant->firstname} " . ($reservation->applicant->middlename ?? '') . " " . ($reservation->applicant->suffix ?? '')),
                    'user_id' => $reservation->user_id,
                ];
            });

        return response()->json(['data' => $appNumbers]);
    }

    public function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')
                ->leftJoin('booklet_numbers', 'users.id', '=', 'booklet_numbers.user_id')
                ->leftJoin('cee_sessions', 'booklet_numbers.cee_term_id', '=', 'cee_sessions.id')
                ->select(
                    'cee_sessions.id AS sessionId',
                    'cee_sessions.name',
                    'booklet_numbers.bookletNo',
                    'booklet_numbers.id',
                    'booklet_numbers.app_no',
                    'booklet_numbers.added_by',
                    'booklet_numbers.created_at',
                    DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', ISNULL(users.middlename, ''), ' ', ISNULL(users.suffix, '')) AS fullname")
                )
                ->where('cee_sessions.status', 'active');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="flex gap-3">
                                <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="inline-block size-3"></i> </a>
                                <a href=' . route('admin.cee.booklet.delete', $row->id) . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md delete-entry size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                            </div>';
                })

                ->rawColumns(['action'])
                ->make(true);

        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'userId' => ['required'],
                'app_no' => ['required'],
                'ceeTermId' => ['required'],
                'bookletNo' => ['required'],
            ]
        );

        $added_by_user = Auth::user()->lastname . ', ' . Auth::user()->firstname;

        $booklet = new BookletNumber();
        $booklet->user_id = $request->userId;
        $booklet->cee_term_id = $request->ceeTermId;
        $booklet->app_no = $request->app_no;
        $booklet->bookletNo = $request->bookletNo;
        $booklet->revision_no = $request->revision_no;
        $booklet->added_by = $added_by_user;
        $booklet->envelopeNo = $request->envelopeNo;
        $booklet->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => $request->bookletNo . ' Booklet Number assigned successfully!',
        ]);
    }

    public function storefromReservation(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'cee_term_id' => 'required|integer',
            'app_no' => 'required|string',
            'bookletNo' => 'required|string',
            'envelopeNo' => 'required|string',
            'revision_no' => 'nullable|string',
        ]);

        // Get the authenticated user's full name
        $validated['added_by'] = Auth::user()->lastname . ', ' . Auth::user()->firstname;

        BookletNumber::create($validated);

        return response()->json([
            'success' => true,
            'message' => $request->bookletNo . ' Booklet Number assigned successfully!',
        ]);
    }

    public function edit(string $id)
    {
        $booklet = BookletNumber::findOrFail($id);

        $user = $booklet->applicant;
        return response()->json([
            'booklet' => $booklet,
            'fullname' => $user->lastname . ', ' . $user->firstname . ' ' . $user->middlename . ' ' . $user->suffix,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'bookletNo' => ['required'],
            ]
        );

        $added_by_user = Auth::user()->lastname . ', ' . Auth::user()->firstname;

        $booklet = BookletNumber::findOrFail($id);
        $booklet->bookletNo = $request->bookletNo;
        $booklet->revision_no = $request->revision_no;
        $booklet->added_by = $added_by_user;
        $booklet->envelopeNo = $request->envelopeNo;
        $booklet->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Booklet details updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booklet = BookletNumber::findOrFail($id);
        $booklet->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
}
