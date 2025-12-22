<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Aro\AROProfileController;
use App\Http\Controllers\Aro\AROStudentsController;
use App\Http\Controllers\Aro\ARODashboardController;
use App\Http\Controllers\Aro\AroEvaluationRequestsController;
use App\Http\Controllers\Pao\PAOAssessmentController;
use App\Http\Controllers\Aro\EnrolledApplicantsController;
use App\Http\Controllers\Aro\AROStudentRequirementsController;
use App\Http\Controllers\Backend\Portal\EvaluationRequestController;


// Route::get('prereg/applicants-for-ranking/get-data', [ARODashboardController::class, 'getListForRanking'])->name('prereg.applicant-for-ranking.get-data');
// Route::get('prereg/applicants/rank/view/{policyId}', [ARODashboardController::class, 'viewRank'])->name('applicants.rank.view');
Route::get('prereg/pending/list', [ARODashboardController::class, 'index'])->name('prereg.pending.index');
Route::get('prereg/pending/data', [ARODashboardController::class, 'getData'])->name('prereg.pending.data');
Route::get('dashboard', [ARODashboardController::class, 'index'])->name('dashboard');

Route::get('students/requirements', [AROStudentRequirementsController::class, 'index'])->name('students.requirements.index');
Route::get('/requirements/{id}', [AROStudentRequirementsController::class, 'getRequirements'])->name('students.requirements.getRequirements');
Route::post('/requirements/save', [AROStudentRequirementsController::class, 'saveRequirements'])->name('students.requirements.save');

Route::put('pre-registration/student-profile/update/{id}', [AROStudentsController::class, 'updateNstp'])->name('applicant-profile.nstp.update');
Route::get('pre-registration/student-profile/{id}/edit', [AROStudentsController::class, 'editNstp'])->name('applicant-profile.nstp.edit');
Route::get('/students', [AROStudentsController::class, 'index'])->name('students.index');
Route::get('/student-confirmed', [AROStudentsController::class, 'getData'])->name('student.confirmed.data');
Route::patch('/students/{id}/cancel-confirmation', [AROStudentsController::class, 'cancelConfirmation'])
    ->name('student.cancel-confirmation.update');


//route for user profile
Route::put('password/update/{user}', [AROProfileController::class, 'updatePassword'])->name('password.update');
Route::put('profile/update/{id}', [AROProfileController::class, 'updateProfile'])->name('user.update');
Route::get('profile', [AROProfileController::class, 'userProfileIndex'])->name('profile.edit');



// route for update transaction type
Route::post('assessment/SarTrialPrograms/{id}/set-transaction-type', [AROStudentsController::class, 'setTransactionType'])->name('transaction.type.update');
// route for update class section
Route::put('assessment/SarTrialPrograms/{id}/profile/class-section', [AROStudentsController::class, 'setClassSection'])->name('class.section.update');
// route for update year level
Route::put('assessment/SarTrialPrograms/{id}/profile/year-level', [AROStudentsController::class, 'setYearLevel'])->name('year.level.update');
// route for curriculum
Route::put('assessment/SarTrialPrograms/{id}/profile/curriculum', [AROStudentsController::class, 'setCurriculum'])->name('curriculum.update');
// route for update table of fee
Route::put('assessment/SarTrialPrograms/{id}/profile/table-of-fee', [AROStudentsController::class, 'setTableOfFee'])->name('table.fee.update');
// route for scholarship provider
Route::put('assessment/SarTrialPrograms/{id}/profile/scho-provider', [AROStudentsController::class, 'setScholarshipProvider'])->name('scholarship.provider.update');
// route for grant template
Route::put('assessment/SarTrialPrograms/{id}/profile/grant-template', [AROStudentsController::class, 'setGrantTemplate'])->name('grant.template.update');
// route for remove subjects
Route::delete('assessment/SarTrialPrograms/remove-subjects', [AROStudentsController::class, 'removeSubjects'])->name('subjects.remove');
// route for class schedules update
Route::put('assessment/SarTrialPrograms/{id}/profile/class-schedules', [AROStudentsController::class, 'setClassSchedules'])->name('class.schedules.update');
// route for get schedules
Route::get('/assessment/get-schedule/{subjectId}/{termId}', [AROStudentsController::class, 'getSchedules'])->name('schedules.get');
// set section as session
Route::post('/section/select/{sectionId}', [AROStudentsController::class, 'selectSection'])->name('section.select');
// route for add subjects
Route::post('assessment/SarTrialPrograms/add-subjects', [AROStudentsController::class, 'addSubjects'])->name('subjects.add');



// route for get SAR by program
Route::get('program/policy/list', [AROStudentsController::class, 'programPolicy'])->name('program.policy.list');
// route for get SAR Students by Policy Id
Route::get('students/program/policy/{id}', [AROStudentsController::class, 'getSarStudents'])->name('sar.students.list');
// route for get students data by policy id
Route::get('students/data/policy', [AROStudentsController::class, 'getStudentsDataByPolicyId'])->name('sar.students.data');
// route for sar assessment
Route::get('students/SarTrialPrograms/{id}/sar-assessment/', [AROStudentsController::class, 'getSarAssessment'])->name('sar.assessment.process');
// route for process enrollment
Route::post('assessment/SarTrialPrograms/{id}/process-enrollment', [AROStudentsController::class, 'processEnrollment'])->name('enrollment.process');
// route for process enrollment
Route::post('assessment/SarTrialPrograms/{id}/process-enrollment=freshmen', [AROStudentsController::class, 'processEnrollmentFreshmen'])->name('enrollment.process.freshmen');

//route to view enrolled applicants
Route::post('pre-registration/enrolled-applicants/update-school-id-status', [EnrolledApplicantsController::class, 'updateStatus'])->name('update.school-id.status');
Route::get('pre-registration/enrolled-applicants/{id}/download-photo', [EnrolledApplicantsController::class, 'downloadProfilePhoto']);
Route::get('pre-registration/enrolled-applicants/{id}/view-profile-photo', [EnrolledApplicantsController::class, 'viewPhoto'])->name('prereg.enrolled-applicants.photo');
Route::get('pre-registration/enrolled-applicants/{reg_no}/download-cor', [EnrolledApplicantsController::class, 'downloadCOR'])->name('prereg.enrolled-applicants.download-cor');
Route::get('pre-registration/enrolled-applicants/{policyId}/index', [EnrolledApplicantsController::class, 'enrolledApplicantsIndex'])->name('prereg.enrolled-applicants.index');
Route::get('pre-registration/enrolled-applicants', [EnrolledApplicantsController::class, 'enrolledApplicantsSummaryIndex'])->name('prereg.enrolled-applicants-summary.index');
Route::get('pre-registration/enrolled-applicants/data', [EnrolledApplicantsController::class, 'getEnrolledApplicantsData'])->name('prereg.enrolled-applicants.data');

//route for Evaluation Requests
Route::get('portal/evaluation-requests/get-all-data', [AroEvaluationRequestsController::class, 'getallData'])->name('portal.evaluation-requests.get-all-data');
// Route::get('portal/evaluation-requests', [EvaluationRequestController::class, 'index'])->name('portal.evaluation-requests.index');
Route::resource('portal/evaluation-requests', AroEvaluationRequestsController::class)->names('portal.evaluation-requests');
