<?php

namespace App\Http\Controllers\Utdc;

use FPDF;
use Carbon\Carbon;
use App\Models\CeeSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportAllExaminees;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ApplicantByActiveCeeTermExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UTDCReportController extends Controller
{
    public function index()
    {
        $ceeSessions = CeeSession::all();
        $activeSession = CeeSession::where('status', 'active')->first(); // Get active session
        return view("utdc.report.report", compact('ceeSessions', 'activeSession'));
    }

    public function getroomData(Request $request)
    {
        if ($request->ajax()) {

            $keyword = $request->input('search.value'); // Get search keyword from the request

            $data = DB::table('reservations')
                ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->select(
                    DB::raw('COUNT(reservations.id) as reservation_count'),
                    'cee_sessions.id as cee_session_id',
                    'cee_sessions.name as cee_session_name',
                    'cee_sessions.status',
                    'rooms.id',
                    'rooms.room_name',
                    'rooms.college_name',
                    'rooms.capacity',
                    'rooms.exam_session',
                    'rooms.campus',
                    'rooms.time',
                    'rooms.schedule',
                )
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('reservations.cee_session_id', $request->cee_session_id);
                })
                ->groupBy('cee_sessions.id', 'cee_sessions.name', 'cee_sessions.status', 'rooms.id', 'rooms.room_name', 'rooms.college_name', 'rooms.capacity', 'rooms.exam_session', 'rooms.campus', 'rooms.time', 'rooms.schedule')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="flex gap-3">
                    <a  href=' . route('utdc.cee.room-adjustment.index', ['roomId' => $row->id]) . ' target="_blank"  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md view-detail size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                    <a href=' . route('utdc.reservation.room.view-applicacant-by-room', ['roomId' => $row->id]) . ' target="_blank" class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="download" class="size-4"></i></a>
                </div>';
                })
                ->addColumn('college_name', function ($query) {
                    $room = $query->room_name;
                    $batch = $query->exam_session;
                    $schedule = $query->schedule ? Carbon::parse($query->schedule)->format('F j, Y') : 'N/A';
                    $time = $query->time;
                    $building = $query->college_name;

                    return '  <div class="flex items-center gap-2">
                                <div class="grow">
                                    <h6 class="mb-1"><a href="#!" class="name">' . $query->campus . '</a></h6>
                                    <h6 class="mb-1"><a href="#!" class="name">' . $building . '</a></h6>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">' . $batch . '</span>
                                    <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-purple-100 border-purple-200 text-purple-500 dark:bg-purple-500/20 dark:border-purple-500/20">' . $schedule . ' ( ' . $time . ' )</span>
                                </div>
                            </div>';
                })
                ->rawColumns(['action', 'college_name'])
                ->make(true);
        }
    }

    public function allroomIndex(Request $request)
    {
        $ceeSessions = CeeSession::all();
        $ceeActiveSession = CeeSession::where('status', 'active')->first();
        return view('utdc.report.room-assignment-index', compact('ceeActiveSession', 'ceeSessions'));
    }

    public function viewApplicantsByRoom(Request $request)
    {
        $data = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->select(
                DB::raw('COUNT(reservations.id) as reservation_count'),
                DB::raw("CONCAT(users.lastname, ', ', users.firstname, ' ', COALESCE(users.middlename, ''), ' ', COALESCE(users.suffix, '')) AS fullname"),
                'reservations.app_no',
                'cee_sessions.id as cee_session_id',
                'cee_sessions.name as cee_session_name',
                'cee_sessions.status',
                'rooms.id',
                'rooms.exam_session',

            )
            ->where('cee_sessions.status', 'active') // Filter for active cee_sessions
            ->where('rooms.id', $request->roomId)
            ->groupBy(
                'users.firstname',
                'users.lastname',
                'users.middlename',
                'users.suffix',
                'reservations.app_no',
                'cee_sessions.id',
                'cee_sessions.name',
                'cee_sessions.status',
                'rooms.id',
                'rooms.exam_session',
            )
            ->orderBy('users.lastname', 'asc')  // Sort by lastname in ascending order
            ->get();

        // Get shared room details
        $roomDetails = DB::table('rooms')
            ->join('reservations', 'rooms.id', '=', 'reservations.room_id')
            ->join('cee_sessions', 'reservations.cee_session_id', '=', 'cee_sessions.id')
            ->select(
                'rooms.room_name',
                'rooms.college_name',
                'rooms.capacity',
                'rooms.exam_session',
                'rooms.campus',
                'rooms.time',
                'rooms.schedule',
                'cee_sessions.name',
                'cee_sessions.id AS ceeses_id',
                DB::raw("COUNT(reservations.id) as reservation_count"),
            )
            ->where('cee_sessions.status', 'active')
            ->where('rooms.status', 'active')
            ->where('rooms.id', $request->roomId)
            ->groupBy(
                'rooms.id',
                'rooms.room_name',
                'rooms.college_name',
                'rooms.capacity',
                'rooms.exam_session',
                'rooms.campus',
                'rooms.time',
                'rooms.schedule',
                'cee_sessions.name',
                'cee_sessions.id',
            )
            ->first();  // Use first() to get only one record


        $pdf = PDF::loadView('utdc.report.room-assignment', compact('data', 'roomDetails'));

        // Stream the PDF instead of downloading it
        return $pdf->stream($request->roomId . 'Applicant-List.pdf');
    }


    public function viewAllApplicants(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->select([
                    'u.id',
                    'u.firstname',
                    'u.lastname',
                    'u.middlename',
                    'u.suffix',
                    'u.phone',
                    'u.email',
                    DB::raw('r.exam_session as batch_number'),
                    'r.campus_id',
                    'r.app_no',
                    'r.firstpriorty_desc',
                    'r.secondpriority_desc',
                    'r.campus_id_prio_prog_2',
                    'r.thirdpriorty_desc',
                    'r.campus_id_prio_prog_3',
                    'rm.college_name',
                    'rm.room_name',
                    'rm.status',
                    'rm.schedule',
                    'rm.time',
                    DB::raw("CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) AS fullname")
                ])
                ->leftJoin('reservations as r', 'u.id', '=', 'r.user_id')
                ->join('cee_sessions as ce', 'r.cee_session_id', '=', 'ce.id')
                ->leftJoin('rooms as rm', 'r.room_id', '=', 'rm.id')
                ->where('rm.status', 'active')
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('r.cee_session_id', $request->cee_session_id);
                });

            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    $searchKeyword = $request->get('search')['value'];

                    if ($searchKeyword) {
                        $query->where(function ($subQuery) use ($searchKeyword) {
                            // Search by fullname
                            $subQuery->orWhereRaw(
                                "CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) LIKE ?",
                                ["%{$searchKeyword}%"]
                            );
                            $subQuery->orWhere('r.exam_session', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('rm.college_name', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('rm.room_name', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('r.app_no', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('r.campus_id', 'LIKE', "%{$searchKeyword}%"); // Ensure campus_id is included
                        });
                    }
                })

                ->addColumn('firstpriorty_desc', function ($row) {
                    $campuses = [
                        1 => "USM-Main",
                        3 => "USM KCC",
                        5 => "USM PALMA CLUSTER",
                        6 => "USM MLANG",
                        7 => "USM Antipas",
                        8 => "USM Pigcawayan"
                    ];

                    $campus_name = $row->firstpriorty_desc . ' - ' . $campuses[$row->campus_id] ?? 'Unknown'; // Default sa 'Unknown' kung wala sa listahan
                    return $campus_name;
                })
                ->addColumn('secondpriority_desc', function ($row) {
                    $campuses = [
                        1 => "USM-Main",
                        3 => "USM KCC",
                        5 => "USM PALMA CLUSTER",
                        6 => "USM MLANG",
                        7 => "USM Antipas",
                        8 => "USM Pigcawayan"
                    ];

                    $campus_name = $row->secondpriority_desc . ' - ' . $campuses[$row->campus_id] ?? 'Unknown'; // Default sa 'Unknown' kung wala sa listahan
                    return $campus_name;
                })
                ->addColumn('thirdpriorty_desc', function ($row) {
                    $campuses = [
                        1 => "USM-Main",
                        3 => "USM KCC",
                        5 => "USM PALMA CLUSTER",
                        6 => "USM MLANG",
                        7 => "USM Antipas",
                        8 => "USM Pigcawayan"
                    ];

                    $campus_name = $row->thirdpriorty_desc . ' - ' . $campuses[$row->campus_id] ?? 'Unknown'; // Default sa 'Unknown' kung wala sa listahan
                    return $campus_name;
                })
                ->rawColumns(['firstpriority_desc', 'secondpriority_desc', 'thirdpriorty_desc'])
                ->make(true);
        }
    }

    public function exportConfirmedReservations()
    {
        return Excel::download(new ExportAllExaminees, 'cee-all-examinees.xlsx');
    }


    private function addCustomHeader(FPDF $pdf)
    {
        // Add the logo to the header
        $logoPath = public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png'); // Path to the logo
        $pdf->Image($logoPath, 12, 8, 20); // x=10, y=10, width=20mm (adjust as needed)

        // Set the font and alignment for the university name
        $pdf->SetFont('Roboto', 'B', 12); // Bold, size 12
        $pdf->SetXY(40, 10); // Move the cursor to the right of the logo
        $pdf->Cell(0, 5, 'University of Southern Mindanao', 0, 1, 'L'); // Center-aligned

        // Set the font for the development center
        $pdf->SetTextColor(0, 0, 255); // Blue
        $pdf->SetFont('Roboto', 'B', 10); // Regular, size 10
        $pdf->SetX(40); // Align text relative to the logo
        $pdf->Cell(0, 5, 'UNIVERSITY TEST DEVELOPMENT CENTER | USM COLLEGE ENTRANCE EXAMINATION', 0, 1, 'L');

        // Add the location
        $pdf->SetFont('Roboto', '', 8); // Regular, size 10
        $pdf->SetTextColor(0, 0, 0); // Black
        $pdf->SetX(40); // Align text relative to the logo
        $pdf->Cell(0, 4, 'Kabacan, Cotabato', 0, 1, 'L');

        // Add a blank line for spacing
        $pdf->Ln(5);

        // Add some spacing before the next section
        $pdf->Ln(5);
    }

    private function calculateColumnWidths($users)
    {

        // Total usable width of the page (excluding margins)
        $totalWidth = 195; // 215 (page width) - 10 (left margin) - 10 (right margin)

        // Assign percentage-based or fixed widths for each column
        $columnWidths = [
            'global_number' => 10, // Fixed width for the numbering column
            'fullname' => 95,      // 50% of the total width for the Name column
            'batch_number' => 25,  // 20% of the total width for the Batch column
            'room_name' => 65,     // Remaining width for the Room column
        ];

        // Ensure the widths add up to the total width
        $totalCalculatedWidth = array_sum($columnWidths);
        if ($totalCalculatedWidth > $totalWidth) {
            // Scale down the widths proportionally if they exceed the total width
            $scaleFactor = $totalWidth / $totalCalculatedWidth;
            foreach ($columnWidths as $key => $value) {
                $columnWidths[$key] = floor($value * $scaleFactor);
            }
        }

        return $columnWidths;
    }

    private function addHeaderToPDF(FPDF $pdf, $columnWidths)
    {
        // Set text color for the header
        $pdf->SetTextColor(0, 0, 0); // White text
        $pdf->SetFillColor(192, 192, 192);    // Dark blue background

        $pdf->SetFont('Roboto', 'B', 10); // Use Roboto Bold

        // Add header cells
        $pdf->Cell($columnWidths['global_number'], 7, '#', 1, 0, 'C', true);
        $pdf->Cell($columnWidths['fullname'], 7, 'Name', 1, 0, 'L', true);
        $pdf->Cell($columnWidths['batch_number'], 7, 'Batch', 1, 0, 'L', true);
        $pdf->Cell($columnWidths['room_name'], 7, 'Room', 1, 1, 'L', true);


        // Reset text color for table rows
        $pdf->SetTextColor(0, 0, 0); // Black text
    }

    private function addRowToPDF(FPDF $pdf, $user, $columnWidths)
    {
        $pdf->SetFont('Roboto', '', 8); // Use Roboto Regular

        // Add row cells with calculated widths
        $pdf->Cell($columnWidths['global_number'], 6, $user->global_number, 1, 0, 'C');
        $pdf->Cell($columnWidths['fullname'], 6, strtoupper($user->fullname ?? ''), 1, 0, 'L');
        $pdf->Cell($columnWidths['batch_number'], 6, $user->batch_number ?? '', 1, 0, 'L');
        $pdf->Cell($columnWidths['room_name'], 6, $user->room_name ?? '', 1, 1, 'L'); // End the row
    }

    public function generateAllCeeExamineePdf(Request $request)
    {
        //import FPDF
        // Streamed response to generate the PDF dynamically
        $response = new StreamedResponse(function () {
            $pdf = new FPDF('P', 'mm', [215.9, 330.2]); // Folio size (8.5 x 13 inches)
            $pdf->SetMargins(10, 10, 10); // Margins: left, top, right
            $pdf->AddPage();

            // Use Roboto font
            $pdf->AddFont('Roboto', '', 'roboto-regular.php'); // Load Roboto Regular
            $pdf->AddFont('Roboto', 'B', 'roboto-bold.php');   // Load Roboto Bold
            $pdf->SetFont('Roboto', '', 10); // Set font size to 10

            // Fetch data dynamically using cursor for memory efficiency
            $users = DB::table('users as u')
                ->select([
                    'u.id',
                    DB::raw('r.exam_session as batch_number'),
                    'r.campus_id',
                    'rm.college_name',
                    'rm.room_name',
                    'rm.status',
                    'rm.schedule',
                    'rm.time',
                    'r.app_no',
                    'ce.name',
                    DB::raw("CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) AS fullname")
                ])
                ->leftJoin('reservations as r', 'u.id', '=', 'r.user_id')
                ->join('cee_sessions as ce', 'r.cee_session_id', '=', 'ce.id')
                ->leftJoin('rooms as rm', 'r.room_id', '=', 'rm.id')
                ->where('rm.status', 'active')
                ->where('ce.status', 'active')
                ->orderBy('rm.room_name', 'asc') // Order by room first
                ->orderBy('batch_number', 'asc') // Then by batch
                ->orderBy('fullname', 'asc')
                ->cursor();

            // Variables to track room and batch, and reset counter
            $currentRoom = null;
            $currentBatch = null;
            $counter = 1;

            // Calculate column widths based on content
            $columnWidths = $this->calculateColumnWidths($users);

            foreach ($users as $user) {
                // Check if the room name or batch number has changed
                if ($currentRoom !== $user->room_name || $currentBatch !== $user->batch_number) {
                    // Add a new page if not the first record
                    if ($currentRoom !== null && $currentBatch !== null) {
                        $pdf->AddPage();
                    }

                    // Update the current room and batch
                    $currentRoom = $user->room_name;
                    $currentBatch = $user->batch_number;
                    $currentBuilding = $user->college_name;
                    $currentTerm = $user->name;

                    // Reset the counter
                    $counter = 1;

                    // Add room, batch, and building-specific header
                    $pdf->SetFont('Roboto', 'B', 10);

                    $this->addCustomHeader($pdf);

                    $pdf->SetFont('Roboto', 'B', 10);
                    $pdf->Cell(0, 5, "CEE Applicants Room Assignment - $currentTerm", 0, 1, 'C');

                    // Display the building (if applicable)
                    if (!empty($currentBuilding)) {
                        $pdf->SetTextColor(0, 128, 0); // RGB for dark green
                        $pdf->Cell(0, 5, "$currentBuilding | $currentBatch | $currentRoom", 0, 1, 'C');
                    }

                    // Add the table header for columns
                    $pdf->SetTextColor(0, 0, 0); // RGB for black
                    $this->addHeaderToPDF($pdf, $columnWidths);
                }

                // Add a row to the PDF
                $user->global_number = $counter++;
                $this->addRowToPDF($pdf, $user, $columnWidths);

                // Check if the cursor position has reached the bottom of the page
                if ($pdf->GetY() > 310) { // Approx 310mm for content height in Folio
                    $pdf->AddPage();

                    $pdf->SetFont('Roboto', 'B', 12);
                    $pdf->Cell(0, 10, "Room: $currentRoom | Batch: $currentBatch", 0, 1, 'L'); // Repeat room and batch
                    $this->addHeaderToPDF($pdf, $columnWidths);

                }
            }

            // Output PDF content to the browser

            $pdf->Output('I', 'USMCEE_Examinee_List.pdf');
        });

        // Set headers for PDF download
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'inline; filename="USMCEE_Examinee_List.pdf"');

        return $response;
    }

    //export view all applicants by cee-session index
    public function applicantViewIndexByCeeSession()
    {
        $ceeSessions = CeeSession::all();
        $ceeActiveSession = CeeSession::where('status', 'active')->first();
        return view('utdc.report.view-applicant-by-exam-session', compact('ceeActiveSession', 'ceeSessions'));
    }

    //export view all applicants by cee-session
    public function getapplicantByActiveCeeSession(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->select([
                    'u.id',
                    'u.firstname',
                    'u.lastname',
                    'u.middlename',
                    'u.suffix',
                    'u.phone',
                    'u.email',
                    DB::raw('r.exam_session as batch_number'),
                    'r.campus_id',
                    DB::raw("CASE
                        WHEN r.campus_id = 1 THEN 'USM-Main'
                        WHEN r.campus_id = 3 THEN 'USM KCC'
                        WHEN r.campus_id = 5 THEN 'USM PALMA CLUSTER'
                        WHEN r.campus_id = 6 THEN 'USM MLANG'
                        WHEN r.campus_id = 7 THEN 'USM Antipas'
                        WHEN r.campus_id = 8 THEN 'USM Pigcawayan'
                        ELSE 'Unknown'
                    END AS campus_name"),
                    'r.app_no',
                    'r.firstpriorty_desc',
                    'r.secondpriority_desc',
                    'r.thirdpriorty_desc',
                    'rm.college_name',
                    'rm.room_name',
                    'rm.status',
                    'rm.schedule',
                    'rm.time',
                    'ce.name',
                    DB::raw("CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) AS fullname")
                ])
                ->leftJoin('reservations as r', 'u.id', '=', 'r.user_id')
                ->join('cee_sessions as ce', 'r.cee_session_id', '=', 'ce.id')
                ->leftJoin('rooms as rm', 'r.room_id', '=', 'rm.id')


                // ->where('ce.status', 'active');
                ->when($request->cee_session_id, function ($query) use ($request) {
                    return $query->where('r.cee_session_id', $request->cee_session_id);
                });

            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    $searchKeyword = $request->get('search')['value'];

                    if ($searchKeyword) {
                        $query->where(function ($subQuery) use ($searchKeyword) {
                            // Search by fullname
                            $subQuery->orWhereRaw(
                                "CONCAT(u.lastname, ', ', u.firstname, ' ', COALESCE(u.middlename, ''), ' ', COALESCE(u.suffix, '')) LIKE ?",
                                ["%{$searchKeyword}%"]
                            );
                            $subQuery->orWhere('r.exam_session', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('rm.college_name', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('rm.room_name', 'LIKE', "%{$searchKeyword}%");
                            $subQuery->orWhere('r.app_no', 'LIKE', "%{$searchKeyword}%");

                            //repeat this because you cant filter the campus_name directly via select
                            $subQuery->orWhereRaw("(CASE
                                WHEN r.campus_id = 1 THEN 'USM-Main'
                                WHEN r.campus_id = 3 THEN 'USM KCC'
                                WHEN r.campus_id = 5 THEN 'USM PALMA CLUSTER'
                                WHEN r.campus_id = 6 THEN 'USM MLANG'
                                WHEN r.campus_id = 7 THEN 'USM Antipas'
                                WHEN r.campus_id = 8 THEN 'USM Pigcawayan'
                                ELSE 'Unknown'
                             END) LIKE ?", ["%{$searchKeyword}%"]);
                        });
                    }
                })
                ->make(true);
        }
    }

    //export to excel
    public function exportapplicantByActiveCeeSession()
    {
        return Excel::download(new ApplicantByActiveCeeTermExport, 'cee-all-applicants-by-cee-active-term.xlsx');
    }

}
