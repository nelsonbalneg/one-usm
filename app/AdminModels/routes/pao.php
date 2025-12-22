<?php

use App\Http\Controllers\Pao\ConfirmedStudentsController;
use App\Http\Controllers\Pao\PAOAssessmentController;
use App\Http\Controllers\Pao\PAOCurriculumController;
use App\Http\Controllers\Pao\PAODashboardController;
use App\Http\Controllers\Pao\PAOProfileController;
use App\Http\Controllers\Pao\StudentRequirementController;
use Illuminate\Support\Facades\Route;


// route for dashboard
Route::get('dashboard', [PAODashboardController::class, 'index'])->name('dashboard');
// route for student requirements
Route::get('students/requirements', [StudentRequirementController::class, 'index'])->name('students.requirements.index');
Route::get('/requirements/{id}', [StudentRequirementController::class, 'getRequirements'])->name('students.requirements.getRequirements');
Route::post('/requirements/save', [StudentRequirementController::class, 'saveRequirements'])->name('students.requirements.save');
// route for confirmed students
Route::get('/students', [ConfirmedStudentsController::class, 'index'])->name('students.index');
Route::get('/student-confirmed', [ConfirmedStudentsController::class, 'getData'])->name('student.confirmed.data');
Route::patch('/students/{id}/cancel-confirmation', [ConfirmedStudentsController::class, 'cancelConfirmation'])->name('student.cancel-confirmation.update');
//route for user profile
Route::put('password/update/{user}', [PAOProfileController::class, 'updatePassword'])->name('password.update');
Route::put('profile/update/{id}', [PAOProfileController::class, 'updateProfile'])->name('user.update');
Route::get('profile', [PAOProfileController::class, 'userProfileIndex'])->name('profile.edit');
// route for assessment
Route::get('assessment/trialprogram', [PAOAssessmentController::class, 'getTrialProgram'])->name('assessment.trialprogram.get');
Route::get('assessment/{id?}', [PAOAssessmentController::class, 'index'])->name('assessment.index');
Route::get('assessment/curriculum/{tenantId}/{studentNo}/{termId}', [PAOCurriculumController::class, 'getCurriculumList'])->name('curriculum.list');
Route::get('assessment/scholarship/{providerId}/grants', [PAOAssessmentController::class, 'getGrantTemplates'])->name('scholarship.grants');
// route for update transaction type
Route::post('assessment/SarTrialPrograms/{id}/set-transaction-type', [PAOAssessmentController::class, 'setTransactionType'])->name('transaction.type.update');
// route for update class section
Route::put('assessment/SarTrialPrograms/{id}/profile/class-section', [PAOAssessmentController::class, 'setClassSection'])->name('class.section.update');
// route for update year level
Route::put('assessment/SarTrialPrograms/{id}/profile/year-level', [PAOAssessmentController::class, 'setYearLevel'])->name('year.level.update');
// route for update table of fee
Route::put('assessment/SarTrialPrograms/{id}/profile/table-of-fee', [PAOAssessmentController::class, 'setTableOfFee'])->name('table.fee.update');
// route for add subjects
Route::post('assessment/SarTrialPrograms/add-subjects', [PAOAssessmentController::class, 'addSubjects'])->name('subjects.add');
// route for scholarship provider
Route::put('assessment/SarTrialPrograms/{id}/profile/scho-provider', [PAOAssessmentController::class, 'setScholarshipProvider'])->name('scholarship.provider.update');
// route for grant template
Route::put('assessment/SarTrialPrograms/{id}/profile/grant-template', [PAOAssessmentController::class, 'setGrantTemplate'])->name('grant.template.update');
// route for curriculum
Route::put('assessment/SarTrialPrograms/{id}/profile/curriculum', [PAOAssessmentController::class, 'setCurriculum'])->name('curriculum.update');
// route for remove subjects
Route::delete('assessment/SarTrialPrograms/remove-subjects', [PAOAssessmentController::class, 'removeSubjects'])->name('subjects.remove');
// route for get schedules
Route::get('/assessment/get-schedule/{subjectId}/{termId}', [PAOAssessmentController::class, 'getSchedules'])->name('schedules.get');
// route for class schedules update
Route::put('assessment/SarTrialPrograms/{id}/profile/class-schedules', [PAOAssessmentController::class, 'setClassSchedules'])->name('class.schedules.update');
// route for process enrollment
Route::post('assessment/SarTrialPrograms/{id}/process-enrollment', [PAOAssessmentController::class, 'processEnrollment'])->name('enrollment.process');
// route for process enrollment
Route::post('assessment/SarTrialPrograms/{id}/process-enrollment-freshmen', [PAOAssessmentController::class, 'processEnrollment2'])->name('enrollment.process.freshmen');
// route for requirements
Route::get('assessment/SarTrialPrograms/{id}/requirements', [PAOAssessmentController::class, 'getRequirements'])->name('requirements.get');
// set section as session
Route::post('/section/select/{sectionId}', [PAOAssessmentController::class, 'selectSection'])->name('section.select');
// no admission requirements
Route::get('students/SarTrialPrograms/{id}/no-admission-requirements', [PAOAssessmentController::class, 'noAdmissionRequirements'])->name('no.admission.requirements');
// route for get SAR by program
Route::get('program/policy/list', [PAOAssessmentController::class, 'programPolicy'])->name('program.policy.list');
// route for get SAR Students by Policy Id
Route::get('students/program/policy/{id}', [PAOAssessmentController::class, 'getSarStudents'])->name('sar.students.list');
// route for get students data by policy id
Route::get('students/data/policy', [PAOAssessmentController::class, 'getStudentsDataByPolicyId'])->name('sar.students.data');
// route for sar assessment
Route::get('students/SarTrialPrograms/{id}/sar-assessment/', [PAOAssessmentController::class, 'getSarAssessment'])->name('sar.assessment.process');