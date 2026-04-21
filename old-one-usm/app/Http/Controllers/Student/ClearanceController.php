<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use Request;


class ClearanceController extends Controller
{
    public function index(Request $request)
    {
        $studentId = auth()->user()->student_id;
        // Get all clearances and group by school_year and semester
        $clearances = Clearance::with(['clearedByUser', 'updatedByUser'])
        ->where('student_id', auth()->user()->student_id)
        ->orderBy('school_year')
        ->orderBy('semester')
        ->orderBy('lastname')
        ->get()
        ->groupBy(fn($item) => $item->school_year . ' - ' . $item->semester);

        return view('student.clearance.index', compact('clearances'));
    }
}
