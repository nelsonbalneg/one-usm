<?php

use App\Exports\ReservationsExport;
use App\Http\Controllers\Utdc\UTDCProfileController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UtdcController;
use App\Http\Controllers\Utdc\UTDCReportController;
use App\Http\Controllers\Utdc\UTDCResultController;
use App\Http\Controllers\Utdc\UTDCCeeSlipController;
use App\Http\Controllers\Utdc\UTDCScanLogsController;
use App\Http\Controllers\Utdc\UTDCReservationController;
use App\Http\Controllers\Utdc\UTDCBookletNumberController;
use App\Http\Controllers\Utdc\UTDCResultTemplateController;
use App\Http\Controllers\Utdc\UTDCRoomAdjustmentController;
use App\Http\Controllers\Utdc\UTDCUsersNoReservationController;


Route::get('/export-reservations', function () {
    return Excel::download(new ReservationsExport, 'reservations.xlsx');
})->name('export.reservations');

Route::get('reservations/stackedbar', [UtdcController::class, 'getReservationsbystackbar'])->name('reservation-stackbar');
Route::get('registration-confirmed-reservation-percentage', [UtdcController::class, 'calcReserveationToConfirmed'])->name('confirmed-reservation.percentage');
Route::get('registration-reservation-percentage', [UtdcController::class, 'calculateRegistrationReservationPercentage'])->name('reservation.percentage');
Route::get('reservations-per-day', [UtdcController::class, 'getReservationsPerDay'])->name('reservations.per-day');
Route::get('reservation/data-by-school', [UtdcController::class, 'getDataBySchool'])->name('reservation.data-by-school');
Route::get('reservation/data-first-priority', [UtdcController::class, 'getDatabyFirstPriority'])->name('reservation.data-first-priority');
Route::get('reservation/data-by-municipality', [UtdcController::class, 'getDataMunicipality'])->name('reservation.data-by-municipility');
Route::get('dashboard', [UtdcController::class, 'dashboard'])->name('dashboard');

Route::get('reservation/load-cee-sessions', [UTDCReservationController::class, 'loadCeeSessions'])->name('reservation.load-cee-session');
Route::get('reservation/get-data', [UTDCReservationController::class, 'getData'])->name('reservation.get-data');
Route::get('reservation/view-details/{reservation}', [UTDCReservationController::class, 'viewDetails'])->name('reservation.details');
Route::get('reservation/index', [UTDCReservationController::class, 'index'])->name('reservation.index');


//route for report
Route::get('cee/exam-slip', [UTDCCeeSlipController::class, 'generateceeExamSlip'])->name('cee.exam-slip');

//route for CEE Result
Route::get('cee/result-slip', [UTDCResultController::class, 'generateceeResultSlip'])->name('cee.result-slip');
Route::get('cee/result-fetch-all', [UTDCResultController::class, 'getData'])->name('cee.result.fetch-data');
Route::post('cee/import/save', [UTDCResultController::class, 'save'])->name('import.save');
Route::match(['get', 'post'], 'cee/import/preview', [UTDCResultController::class, 'preview'])->name('import.preview');
Route::post('cee/import', [UTDCResultController::class, 'import'])->name('import');
Route::get('cee/result-import-view', [UTDCResultController::class, 'importIndex'])->name('cee.result-import.index');
Route::resource('cee-result', UTDCResultController::class);

//route for exporting data from reservations confirmed status
Route::get('reservation/export-confirmed-reservations', [UTDCReservationController::class, 'exportConfirmedReservations'])->name('reservation.export.confirmed-status');
Route::get('reservation/export-all-examinees', [UTDCReportController::class, 'exportConfirmedReservations'])->name('reservation.export.cee-examinees');
Route::get('reservation/export/applicants-by-cee-term', [UTDCReportController::class, 'exportapplicantByActiveCeeSession'])->name('reservation.export.applicantByActiveCeeSession');

//route for reports
Route::get('reservation/view/all-applicants-by-active-cee-session-index', [UTDCReportController::class, 'applicantViewIndexByCeeSession'])->name('reservation.view-applicant-by-active-cee-sessison.index');
Route::get('reservation/view/all-applicants-by-active-cee-session', [UTDCReportController::class, 'getapplicantByActiveCeeSession'])->name('reservation.view-applicant-by-active-cee-sessison.view');
Route::get('reservation/all-cee-examinee-report', [UTDCReportController::class, 'generateAllCeeExamineePdf'])->name('reservation.all-cee-examinee-report.pdf');
Route::get('reservation/room/report/view-all-applicant', [UTDCReportController::class, 'viewAllApplicants'])->name('reservation.room.view-all-applicant');
Route::get('reservation/room/report', [UTDCReportController::class, 'index'])->name('reservation.room.index');
Route::get('reservation/room/report/get-room-data', [UTDCReportController::class, 'getroomData'])->name('reservation.room.get-room-data');
Route::get('reservation/room/report/view-applicacant-by-room', [UTDCReportController::class, 'viewApplicantsByRoom'])->name('reservation.room.view-applicacant-by-room');
Route::get('reservation/room/report/all-room-assignment', [UTDCReportController::class, 'allroomIndex'])->name('report.all-room.index');

//routes for room adjustment
Route::put('cee/room-adjust/{id}', [UTDCRoomAdjustmentController::class, 'update'])->name('room.adjust.update');
Route::get('cee/room-adjust/{id}/edit', [UTDCRoomAdjustmentController::class, 'edit'])->name('room.adjust.edit');
Route::get('cee/rooms-by-session', [UTDCRoomAdjustmentController::class, 'getRoomsByExamSession'])->name('rooms.by-exam-session');
Route::get('cee/room-adjustment/get-data', [UTDCRoomAdjustmentController::class, 'getData'])->name('cee.room-adjustment.get-data');
Route::get('cee/room-adjustment', [UTDCRoomAdjustmentController::class, 'index'])->name('cee.room-adjustment.index');

//route for users without reservations
Route::get('no-resevation', [UTDCUsersNoReservationController::class, 'index'])->name('user.no-reservation.index');
Route::get('no-reservation/get-data', [UTDCUsersNoReservationController::class, 'getData'])->name('no-reservation.get-data');
Route::get('no-reservation/export', [UTDCUsersNoReservationController::class, 'exportNoReservations'])->name('no-reservation.export');

//route for scan logs
Route::get('cee/scan-logs/fetch-all', [UTDCScanLogsController::class, 'getData'])->name('cee.scan-logs-fetch-all-data');
Route::get('cee/scan-logs', [UTDCScanLogsController::class, 'index'])->name('cee.scan-logs');

//route for booklet number cee.booklet.fetch-data
Route::get('fetch-app-numbers', [UTDCBookletNumberController::class, 'fetchAppNumbers']);
Route::get('cee/booklet/fetch-data', [UTDCBookletNumberController::class, 'fetchData'])->name('cee.booklet.fetch-data');
Route::delete('cee/booklet/delete/{id}', [UTDCBookletNumberController::class, 'destroy'])->name('cee.booklet.delete');
Route::put('cee/booklet/{id}', [UTDCBookletNumberController::class, 'update'])->name('cee.booklet.update');
Route::get('cee/booklet/{id}/edit', [UTDCBookletNumberController::class, 'edit'])->name('cee.booklet.edit');
Route::post('cee/booklet-assign-save', [UTDCBookletNumberController::class, 'store'])->name('cee.booklet.store');
Route::get('cee/booklet', [UTDCBookletNumberController::class, 'index'])->name('cee.booklet.index');

//route for resulttemplate
Route::get('cee/result/template/get-data', [UTDCResultTemplateController::class, 'getData'])->name('cee.result-template.get-data');
Route::get('cee/result/template', [UTDCResultTemplateController::class, 'index'])->name('cee.result-template.index');

//route for user profile
Route::put('password/update/{user}', [UTDCProfileController::class, 'updatePassword'])->name('password.update');
Route::put('profile/update/{id}', [UTDCProfileController::class, 'updateProfile'])->name('user.update');
Route::get('profile', [UTDCProfileController::class, 'userProfileIndex'])->name('profile.edit');
