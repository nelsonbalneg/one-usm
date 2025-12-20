<?php

use App\Http\Controllers\MikroTikController;
use App\Http\Controllers\Student\AcademicEvaluationController;
use App\Http\Controllers\Student\CcdCaresController;
use App\Http\Controllers\Student\ClearanceController;
use App\Http\Controllers\Student\CurriculumController;
use App\Http\Controllers\Student\FacultyEvaluationController;
use App\Http\Controllers\Student\MyApplicationController;
use App\Http\Controllers\Student\MyProfileController;
use App\Http\Controllers\Student\ReportOfGradesController;
use App\Http\Controllers\Student\SarController;
use App\Http\Controllers\Student\VirtualMapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;


// Route::middleware(['check.maintenance'])->group(function () {
 Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

// Route to view profile
Route::get('my-profile', [MyProfileController::class, 'index'])->name('applicant.profile');
Route::get('my-profile/edit', [MyProfileController::class, 'edit'])->name('applicant.profile.edit');
Route::put('my-profile', [MyProfileController::class, 'update'])->name('applicant.profile.update');
Route::put('my-profile/photo', [MyProfileController::class, 'updatePhoto'])->name('applicant.profile.update-photo');


// ccd cares
Route::get('/ccdcares', [CcdCaresController::class, 'index'])->name('student.ccdcares.index');
// sar home page
Route::get('/sar', [SarController::class, 'index'])->name('student.sar.index');
//route for applicant application status
Route::get('/ccd/connect', [CcdCaresController::class, 'connect'])->name('student.ccdcares.connect');
//route for applicant application status
Route::get('application-status', [MyApplicationController::class, 'index'])->name('applicant.application.index');
//route for applicant application status
Route::get('/sar/connect', [SarController::class, 'connect'])->name('student.sar.connect');
// report of grades route
Route::get('/report-of-grades',[ReportOfGradesController::class, 'index'])->name('student.report-of-grades.index');
// request internet access to mikrotik
Route::get('/internet/request', [MikroTikController::class, 'showForm'])->name('internet.request.form');
Route::post('/internet/request', [MikroTikController::class, 'addHotspotUser'])->name('internet.request.submit');
// route for curriculum
Route::get('/curriculum',[CurriculumController::class,'index'])->name('student.curriculum.index');
// route for academic evaluation
Route::get('/academic-evaluation',[AcademicEvaluationController::class,'index'])->name('student.academic-evaluation.index');
// route to submit academic evaluation request
Route::post('/academic-evaluation/store', [AcademicEvaluationController::class, 'store'])->name('student.academic-evaluation.store');
// route to cancel academic evaluation request
Route::put('/academic-evaluation/{id}/cancel', [AcademicEvaluationController::class, 'cancel'])->name('student.academic-evaluation.cancel');
// route for faculty evaluation 
Route::get('/faculty-evaluation', [FacultyEvaluationController::class, 'index'])->name('student.faculty-evaluation.index');
//route for faculy evaluation connect
Route::get('/faculty-evaluation/connect', [FacultyEvaluationController::class, 'connect'])->name('student.faculty-evaluation.connect');
// route for virtual map main
Route::get('/virtual-map/main', [VirtualMapController::class, 'index'])->name('student.virtual-map.index');
// route for virtual map kcc
Route::get('/virtual-map/kcc', [VirtualMapController::class, 'kcc'])->name('student.virtual-map.kcc');
// route for virtual map libungan
Route::get('/virtual-map/libungan', [VirtualMapController::class, 'libungan'])->name('student.virtual-map.libungan');
// route for clearance
Route::get('/clearance', [ClearanceController::class, 'index'])->name('student.clearance.index');



//     Route::put('/test-update/{id}', [StudentProfileController::class, 'update']);
//     Route::put('cee/update-photo/{id}', [StudentProfileController::class, 'uploadPhoto'])->name('cee.update-photo');
//     Route::resource('profile', StudentProfileController::class);



//     Route::get('cee/schoolname', [StudentProfileController::class, 'school_name'])->name('school_list.index');

//     Route::get('cee/checklrn', [StudentProfileController::class, 'getLrn'])->name('detectlrn.index');

//     // Route::post('cee/upload-image', [StudentProfileController::class, 'upload']);
//     Route::post('cee/upload-image', [StudentProfileController::class, 'upload'])->name('upload_image');

    Route::get('cee/upload-image-form', function () {
        return view('student.profile.upload'); // Accesses the upload.blade.php inside views/student/profile
    });

    //route for report

    Route::get('/download-pdf/{filename}', function ($filename) {
        $filePath = storage_path('app/public/reports/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    })->name('download-pdf');
// });
