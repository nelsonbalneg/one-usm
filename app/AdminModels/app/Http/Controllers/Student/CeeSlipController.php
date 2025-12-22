<?php

namespace App\Http\Controllers\Student;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class CeeSlipController extends Controller
{

    public function generateceeExamSlip(Request $request)
    {
        $app_no = Crypt::decryptString($request->app_no);
        $cee_reservation = Reservation::where('app_no', $app_no)->first();

        $pdf = PDF::loadView('student.cee-slip.exam-slip', compact('cee_reservation'));

        // Stream the PDF instead of downloading it
        return $pdf->stream('usmcee-slip.pdf');
    }
}
