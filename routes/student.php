<?php

use App\Http\Controllers\Student\MyApplicationController;
use App\Http\Controllers\Student\MyProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;


// Route::middleware(['check.maintenance'])->group(function () {
 Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

//route for Applicant Profile
Route::get('my-profile', [MyProfileController::class, 'index'])->name('applicant.profile');
Route::put('my-profile/update/{id}', [MyProfileController::class, 'updateProfile'])->name('applicant.profile.update');
Route::put('my-profile/update-photo/{id}', [MyProfileController::class, 'updatePhoto'])->name('applicant.profile.update-photo');


//route for applicant application status
Route::get('application-status', [MyApplicationController::class, 'index'])->name('applicant.application.index');

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
