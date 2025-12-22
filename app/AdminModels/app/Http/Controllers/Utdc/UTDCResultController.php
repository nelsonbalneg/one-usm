<?php

namespace App\Http\Controllers\Utdc;


use App\Models\Result;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\CeeSession;
use Illuminate\Http\Request;
use App\Imports\ImportCeeResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Pagination\LengthAwarePaginator;

class UTDCResultController extends Controller
{
    public function index()
    {
        $ceeSessionAll = CeeSession::all();
        $ceeSession = CeeSession::where('status', 'active')->first();

        $appNumbers = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->select(
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname"),
                'reservations.app_no',
                'reservations.user_id'
            )
            ->where('cee_sessions.status', 'active')
            ->where('reservations.status', 'confirmed')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('results')
                    ->whereColumn('results.app_no', 'reservations.app_no');
            })
            ->get();

        return view("utdc.result.result", compact('ceeSession', 'appNumbers', 'ceeSessionAll'));
    }

    public function importIndex()
    {
        return view("utdc.result.import-result");
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new ImportCeeResult, $request->file('file'));

        return redirect()->back()->with('success', 'Data Imported Successfully');
    }

    public function preview(Request $request)
    {
        // Ensure the file is uploaded only on the first request
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx',
            ]);

            // Load the file and convert it to a collection
            $import = new ImportCeeResult;
            $rows = Excel::toCollection($import, $request->file('file'));

            if ($rows->isEmpty() || $rows[0]->isEmpty()) {
                return back()->with('error', 'The uploaded file contains no data.');
            }

            // Retrieve all `app_no` values for checking duplicates
            $appNos = $rows[0]->pluck('app_no')->toArray();

            // Fetch existing records from the database in chunks to avoid exceeding SQL Server's parameter limit
            $existingRecords = collect();
            collect($appNos)
                ->chunk(2000) // Chunk size slightly less than 2100 for safety
                ->each(function ($chunk) use (&$existingRecords) {
                    $duplicates = Result::whereIn('app_no', $chunk)->pluck('app_no');
                    $existingRecords = $existingRecords->merge($duplicates);
                });

            // Add `is_duplicate` flag to each row
            $rows = $rows[0]->map(function ($row) use ($existingRecords) {
                $row['is_duplicate'] = $existingRecords->contains($row['app_no']);
                return $row;
            });

            // Store only the first 500 rows in session for preview
            session(['previewRows' => $rows->take(500)]);

            // Store the full dataset in cache
            cache()->put('fullDataset', $rows, now()->addHours(2));

            // Store total row count in session
            session(['totalRowsCount' => $rows->count()]);
        }

        // Retrieve session variables to avoid repeated redirections
        $items = collect(session('previewRows', []));
        if ($items->isEmpty()) {
            return back()->with('error', 'No data available for preview.');
        }

        // Paginate the preview data
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 50;
        $paginatedRows = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            session('totalRowsCount', $items->count()),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('utdc.result.import-result', compact('paginatedRows'));
    }

    public function save(Request $request)
    {

        // Retrieve the full dataset from cache
        $allRows = cache()->get('fullDataset', collect());

        if ($allRows->isEmpty()) {
            return back()->with('error', 'No data available to save.');
        }

        // Validate all rows for required fields
        $validatedRows = $allRows->filter(function ($row) {
            return !is_null($row['science']) && $row['science'] !== '' &&
                !is_null($row['math']) && $row['math'] !== '' &&
                !is_null($row['humanities']) && $row['humanities'] !== '' &&
                !is_null($row['inductive']) && $row['inductive'] !== '' &&
                !is_null($row['csa']) && $row['csa'] !== '';
        });

        if ($validatedRows->isEmpty()) {
            return back()->with('error', 'All required fields must be filled.');
        }

        // Check for duplicates in the database in chunks to avoid exceeding SQL Server's parameter limit
        $existingRecords = collect();
        $validatedRows->pluck('app_no')
            ->chunk(2000) // Chunk size slightly below 2100 for safety
            ->each(function ($chunk) use (&$existingRecords) {
                $duplicates = Result::whereIn('app_no', $chunk)->pluck('app_no');
                $existingRecords = $existingRecords->merge($duplicates);
            });

        // Filter out duplicates
        $newRows = $validatedRows->filter(function ($row) use ($existingRecords) {
            return !$existingRecords->contains($row['app_no']);
        });

        if ($newRows->isEmpty()) {
            return back()->with('error', 'No new data to save. All records are duplicates.');
        }

        // Calculate maximum batch size based on SQL Server's parameter limit
        $columnsPerRow = 12; // Number of columns in the insert statement
        $maxBatchSize = floor(2100 / $columnsPerRow); // Maximum rows per batch (e.g., 175 rows)

        // Insert data in strict sub-chunks
        $newRows->chunk($maxBatchSize)->each(function ($chunk) {
            $chunk->chunk(100)->each(function ($subChunk) { // Further sub-chunk if needed for safety
                DB::transaction(function () use ($subChunk) {
                    $insertData = $subChunk->map(function ($row) {
                        return [
                            'cee_session_id' => $row['cee_session_id'],
                            'user_id' => $row['user_id'],
                            'app_no' => $row['app_no'],
                            'fullname' => $row['fullname'],
                            'science' => $row['science'],
                            'math' => $row['math'],
                            'humanities' => $row['humanities'],
                            'inductive' => $row['inductive'],
                            'added_by_id' => Auth::user()->id,
                            'csa' => $row['csa'],
                            'status' => $row['status'],
                            'created_at' => now()->setTimezone('Asia/Manila'),
                        ];
                    })->toArray();

                    Result::insert($insertData);
                });
            });
        });

        // Clear cache after saving
        cache()->forget('fullDataset');

        return back()->with('success', 'All data has been saved successfully!');
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
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('results.cee_session_id', $request->cee_session_id);
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->status == 'posted') {
                        $encryptedAppNo = Crypt::encryptString($row->app_no);

                        return ' <div class="flex gap-3">
                        <a href=' . route('utdc.cee.result-slip', ['app_no' => $encryptedAppNo]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                        </div>';

                    } else {
                        return ' <div class="flex gap-3">
                        <a data-id=' . $row->id . ' class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-result size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a data-id=' . $row->id . '  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md edit-entry size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    }

                })
                ->filter(function ($query) use ($request) {
                    $query->where('cee_sessions.status', '=', 'active'); // Always enforce this condition

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

    public function edit(string $id)
    {
        $ceeresult = Result::findOrFail(id: $id);
        return response()->json([
            'ceeresult' => $ceeresult
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'science' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
            'math' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
            'humanities' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
            'inductive' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
            // 'abstract' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
            'csa' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
            'remarks' => 'required|string|max:255',
        ]);

        $ceeresultrfc = Result::findOrFail($id);
        $ceeresultrfc->science = $request->science;
        $ceeresultrfc->math = $request->math;
        $ceeresultrfc->humanities = $request->humanities;
        $ceeresultrfc->inductive = $request->inductive;
        $ceeresultrfc->added_by_id = Auth::user()->id;
        $ceeresultrfc->csa = $request->csa;
        $ceeresultrfc->remarks = $request->remarks;
        $ceeresultrfc->ispending_edit = 'yes';
        $ceeresultrfc->status = 'pending';
        $ceeresultrfc->created_at = now()->setTimezone('Asia/Manila');
        $ceeresultrfc->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Request for Change for CEE Result successfully submitted!',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'science' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
                'math' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
                'humanities' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
                'inductive' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
                // 'abstract' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
                'csa' => 'nullable|regex:/^\d+(\.\d{1,3})?$/',
                'remarks' => 'required|string|max:255',
                'app_no' => 'required|unique:results,app_no',
                'fullname' => 'required'
            ],
            [
                'app_no.unique' => 'The app number already exists. Please check the app number.',
            ]
        );

        $ceeSession = CeeSession::where('status', 'active')->first();
        $ceeSessionsid = $ceeSession->id;

        $ceeresult = new Result;
        $ceeresult->fullname = $request->fullname;
        $ceeresult->cee_session_id = $ceeSessionsid;
        $ceeresult->app_no = $request->app_no;
        $ceeresult->science = $request->science;
        $ceeresult->math = $request->math;
        $ceeresult->humanities = $request->humanities;
        $ceeresult->inductive = $request->inductive;
        $ceeresult->added_by_id = Auth::user()->id;
        $ceeresult->csa = $request->csa;
        $ceeresult->remarks = $request->remarks;
        $ceeresult->user_id = $request->addceeuserid;
        $ceeresult->status = 'posted';
        $ceeresult->created_at = now()->setTimezone('Asia/Manila');
        $ceeresult->save();

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'Request for Change for CEE Result successfully submitted!',
        ]);
    }

    public function generateceeResultSlip(Request $request)
    {

        $decryptapp_no = Crypt::decryptString($request->app_no);

        $ceeresult = DB::table('reservations')
            ->join('results', 'reservations.app_no', '=', 'results.app_no')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->where('reservations.app_no', $decryptapp_no)
            ->select(
                'reservations.user_id',
                'reservations.app_no',
                'reservations.firstpriorty_desc',
                'reservations.secondpriority_desc',
                'reservations.thirdpriorty_desc',
                'reservations.campus_id',
                'reservations.is_repeat_exam',
                'users.email',
                'users.sex',
                'users.phone',
                'users.photo',
                'users.birthdate',
                'results.fullname',
                'results.science',
                'results.math',
                'results.humanities',
                'results.inductive',
                'results.csa',
                'results.created_at',
                'cee_sessions.name',
                'rooms.schedule',
            )
            ->first();

        // Pass the base64 QR code string to the view for inclusion in the PDF
        $pdf = PDF::loadView('utdc.result.result-slip', compact('ceeresult'));

        // Stream the PDF instead of downloading it
        return $pdf->stream("{$ceeresult->app_no}-usmcee-result.pdf");
    }
}
