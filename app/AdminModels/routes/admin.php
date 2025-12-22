<?php


use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LogsController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\RoomsController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\TermIDController;
use App\Http\Controllers\Backend\BookletController;
use App\Http\Controllers\Backend\CeeSlipController;
use App\Http\Controllers\Backend\ChedProfileReport;
use App\Http\Controllers\Backend\ProgramController;
use App\Http\Controllers\Backend\CEEResultContoller;
use App\Http\Controllers\Backend\ScanLogsController;
use App\Http\Controllers\Backend\AnalyticsController;
use App\Http\Controllers\Backend\LegacyUserController;
use App\Http\Controllers\Backend\PreregTermController;
use App\Http\Controllers\Backend\ReservationController;
use App\Http\Controllers\Backend\RFCCEEScoreController;
use App\Http\Controllers\Backend\SchoolNamesController;
use App\Http\Controllers\Backend\SiteSettingsController;
use App\Http\Controllers\Backend\PreregProfileController;
use App\Http\Controllers\Backend\CeeExamSessionController;
use App\Http\Controllers\Backend\NoReservationsController;
use App\Http\Controllers\Backend\ResultTemplateController;
use App\Http\Controllers\Backend\RoomAdjustmentController;
use App\Http\Controllers\Backend\PreregAnalyticsController;
use App\Http\Controllers\Backend\PreregistrationController;
use App\Http\Controllers\Backend\ViewOnlineUsersController;
use App\Http\Controllers\Backend\Portal\ClearanceController;
use App\Http\Controllers\Backend\Portal\PortalUserController;
use App\Http\Controllers\Backend\ReservationHistoryController;
use App\Http\Controllers\Backend\Portal\EvaluationRequestController;
use App\Http\Controllers\Backend\Portal\InternetAccountRequestController;

Route::get('/export-reservations', function () {
    return Excel::download(new ReservationsExport, 'reservations.xlsx');
})->name('export.reservations');

Route::get('reservations/stackedbar', [AdminController::class, 'getReservationsbystackbar'])->name('reservation-stackbar');
Route::get('registration-confirmed-reservation-percentage', [AdminController::class, 'calcReserveationToConfirmed'])->name('confirmed-reservation.percentage');
Route::get('registration-reservation-percentage', [AdminController::class, 'calculateRegistrationReservationPercentage'])->name('reservation.percentage');
Route::get('reservations-per-day', [AdminController::class, 'getReservationsPerDay'])->name('reservations.per-day');
Route::get('reservation/data-by-school', [AdminController::class, 'getDataBySchool'])->name('reservation.data-by-school');
Route::get('reservation/data-first-priority', [AdminController::class, 'getDatabyFirstPriority'])->name('reservation.data-first-priority');
Route::get('reservation/data-by-municipality', [AdminController::class, 'getDataMunicipality'])->name('reservation.data-by-municipility');
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//route for user management
Route::post('user/update-ched-profile-status', [UserController::class, 'updateStatus'])->name('update.ched-profile.status');
Route::get('user/reservation-history-data/', [UserController::class, 'userreservationhistorygetData'])->name('user.reservation-history.data');
Route::get('user/reservation-history/{id}', [UserController::class, 'userreservationHistoryindex'])->name('user.reservation-history.index');
Route::post('user/add-new-user', [UserController::class, 'addUser'])->name('user.add-new-user');

Route::get('user/detailed-info/{id}', [UserController::class, 'detailedInfo'])->name('user.detailed-info.index');
Route::put('user/update-photo/{id}', [UserController::class, 'uploadPhoto'])->name('cee.update-photo');
Route::put('user/update-profile/{id}', [UserController::class, 'update'])->name('cee.update-profile');
Route::get('user/schoolname', [UserController::class, 'school_name'])->name('school_list.index');

//route for admin users
Route::get('user/admin-users', [UserController::class, 'adminUserIndex'])->name('user.admin.index');
Route::get('user/get-all-admin', [UserController::class, 'getAdminUsers'])->name('user.get-all-admin.show');

//route for PAO users
Route::get('user/program-admission-officers', [UserController::class, 'paoUserIndex'])->name('user.pao.index');
Route::get('user/get-all-program-admission-officers', [UserController::class, 'getPaoUsers'])->name('user.get-all-pao.show');

//route for ARO users
Route::get('user/admission-records-office', [UserController::class, 'aroUserIndex'])->name('user.aro.index');
Route::get('user/get-all-admission-records-office', [UserController::class, 'getAroUsers'])->name('user.get-all-aro.show');

//route for dean users
Route::get('user/college-deans', [UserController::class, 'deanUserIndex'])->name('user.dean.index');
Route::get('user/get-all-college-deans', [UserController::class, 'getDeanUsers'])->name('user.get-all-dean.show');

//route for cee users
Route::get('user/cee-applicant', [UserController::class, 'applicantUserIndex'])->name('user.cee-applicant.index');
Route::get('user/get-all-cee-applicant', [UserController::class, 'getApplicantUsers'])->name('user.get-all-applicant.show');



Route::post('user/assign-programs', [UserController::class, 'storeUserAssignedProgram'])->name('user.assign-programs');
Route::put('user/update-password/{id}', [UserController::class, 'storePassword'])->name('user.password.update');
Route::get('user/change-password/{id}/edit', [UserController::class, 'changePassword'])->name('user.change-password.index');
Route::put('/user/{id}', [UserController::class, 'updateData'])->name('user.update-data');
Route::get('user/get-all-data', [UserController::class, 'getallUsers'])->name('user.get-all-users');
Route::get('user/programs', [UserController::class, 'programPolicy'])->name('user.program-policy');


Route::resource('user', UserController::class);

//route for rooms
Route::get('cee/rooms/slots', [RoomsController::class, 'getAvailableSlots'])->name('cee.rooms.slots');
Route::get('cee/view-rooms', [RoomsController::class, 'viewRooms'])->name('cee.rooms.view');
Route::put('room/add-slot/{id}', [RoomsController::class, 'addSlot'])->name('room.add-slot');
Route::put('room/change-status', [RoomsController::class, 'changeStatus'])->name('room.change-status');
Route::get('room/get-all-data', [RoomsController::class, 'getallRooms'])->name('room.get-all');
Route::resource('rooms', RoomsController::class);

//route for reservations
Route::get('cee/result-slip', [ReservationHistoryController::class, 'generateceeResultSlip'])->name('cee.result-slip');
Route::get('reservation/history/details', [ReservationHistoryController::class, 'reservationHistoryData'])->name('reservation.history-details');
Route::get('reservation/history/{id}', [ReservationHistoryController::class, 'reservationHistoryindex'])->name('reservation.history.index');

//for updating the programs
Route::put('reservation/update-reservation/{id}', [ReservationController::class, 'updateReservationindex'])->name('reservation.update-reservation.update');
Route::get('reservation/edit-reservation/{id}/edit', [ReservationController::class, 'editReservationindex'])->name('reservation.reservation.edit');

Route::get('reservation/create-reservation/validate-type', [ReservationController::class, 'checkifRetaker'])->name('reservation.create.validate-type');
Route::get('reservation/create-reservation/load-users', [ReservationController::class, 'createReservationindex'])->name('reservation.create.index');
Route::get('cee/get-programs-by-campus', [ReservationController::class, 'getProgramByRealCampusId'])->name('get-programs.campus');
Route::post('cee/reserve/submit', [ReservationController::class, 'store'])->name('reserve.store');
Route::get('cee/rooms-by-session/res', [ReservationController::class, 'resgetRoomsByExamSession'])->name('res.rooms.by-exam-session');
Route::get('cee/campus-list', [ReservationController::class, 'getCampusList'])->name('campus.get-list');

Route::post('reservation/update-reservation-status', [ReservationController::class, 'updateStatus'])->name('update.reservation.status');
Route::put('reservation/update-cee-examinee-type', [ReservationController::class, 'updateCEEType'])->name('reservation.cee-examinee-type.update');
Route::get('reservation/load-cee-sessions', [ReservationController::class, 'loadCeeSessions'])->name('reservation.load-cee-session');
Route::get('reservation/confirm-res/get-data-index', [ReservationController::class, 'getConfirmResDataindex'])->name('reservation.confirm.index');
Route::get('reservation/confirm-res/get-data', [ReservationController::class, 'getConfirmResData'])->name('reservation.confirm');
Route::get('reservation/get-data', [ReservationController::class, 'getData'])->name('reservation.get-data');
Route::get('reservation/view-details/{reservation}', [ReservationController::class, 'viewDetails'])->name('reservation.details');
Route::delete('reservation/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
Route::get('reservation/index', [ReservationController::class, 'index'])->name('reservation.index');

//route for exporting data from reservations confirmed status
Route::get('reservation/all-cee-examinee-report', [ReportController::class, 'generateAllCeeExamineePdf'])->name('reservation.all-cee-examinee-report.pdf');
Route::get('reservation/export-confirmed-reservations', [ReservationController::class, 'exportConfirmedReservations'])->name('reservation.export.confirmed-status');
Route::get('reservation/export-all-examinees', [ReportController::class, 'exportConfirmedReservations'])->name('reservation.export.cee-examinees');
Route::get('reservation/export/applicants-by-cee-term', [ReportController::class, 'exportapplicantByActiveCeeSession'])->name('reservation.export.applicantByActiveCeeSession');

//route for reports
Route::get('reservation/view/all-applicants-by-active-cee-session-index', [ReportController::class, 'applicantViewIndexByCeeSession'])->name('reservation.view-applicant-by-active-cee-sessison.index');
Route::get('reservation/view/all-applicants-by-active-cee-session', [ReportController::class, 'getapplicantByActiveCeeSession'])->name('reservation.view-applicant-by-active-cee-sessison.view');
Route::get('reservation/room/report/view-all-applicant', [ReportController::class, 'viewAllApplicants'])->name('reservation.room.view-all-applicant');
Route::get('reservation/room/report', [ReportController::class, 'index'])->name('reservation.room.index');
Route::get('reservation/room/report/get-room-data', [ReportController::class, 'getroomData'])->name('reservation.room.get-room-data');
Route::get('reservation/room/report/view-applicacant-by-room', [ReportController::class, 'viewApplicantsByRoom'])->name('reservation.room.view-applicacant-by-room');
Route::get('reservation/room/report/all-room-assignment', [ReportController::class, 'allroomIndex'])->name('report.all-room.index');

//route for cee exam session
Route::put('cee/exam-session/change-status', [CeeExamSessionController::class, 'changeStatus'])->name('exam-session.change-status');
Route::get('cee/exam-session/data', [CeeExamSessionController::class, 'getData'])->name('cee.exam-session.data');

//route for viewing result via cee-session
Route::get('cee/exam-session/view-results/index/{id}', [CeeExamSessionController::class, 'viewresultindex'])->name('cee.exam-session.view-results.index');
Route::get('cee/exam-session/view-results', [CeeExamSessionController::class, 'getResult'])->name('cee.exam-session.view-results');
Route::resource('exam-session', CeeExamSessionController::class);

//route for CEE Legacy Users
Route::get('cee/legacy/users', [LegacyUserController::class, 'getUsers'])->name('cee.legacy.user-data');
Route::get('cee/legacy', [LegacyUserController::class, 'index'])->name('cee.legacy.index');

//route for school names
Route::delete('cee/school-name/{id}', [SchoolNamesController::class, 'destroy'])->name('cee.school-name.destroy');
Route::get('cee/school-name/{id}/edit', [SchoolNamesController::class, 'edit'])->name('cee.school-names.edit');
Route::put('cee/school/update/{id}', [SchoolNamesController::class, 'update'])->name('cee.school.update');
Route::post('cee/school/add-new', [SchoolNamesController::class, 'store'])->name('cee.school.store');
Route::get('cee/school-names/get', [SchoolNamesController::class, 'getData'])->name('cee.school-names.data');
Route::get('cee/school-names', [SchoolNamesController::class, 'index'])->name('cee.school-names.index');

//route for CEE Result
// Route::post('cee/result/delete-result/{id}', [CEEResultContoller::class, 'deleteResult'])->name('cee.delete-result');
Route::post('cee/result/unpost-result/{id}', [CEEResultContoller::class, 'unpostResult'])->name('cee.unpost-result');
Route::post('cee/result/post-result/{id}', [CEEResultContoller::class, 'postResult'])->name('cee.post-result');

Route::get('cee/result-fetch-all', [CEEResultContoller::class, 'getData'])->name('cee.result.fetch-data');
Route::post('cee/import/save', [CEEResultContoller::class, 'save'])->name('import.save');
Route::match(['get', 'post'], 'cee/import/preview', [CEEResultContoller::class, 'preview'])->name('import.preview');
Route::post('cee/import', [CEEResultContoller::class, 'import'])->name('import');
Route::get('cee/result-import-view', [CEEResultContoller::class, 'importIndex'])->name('cee.result-import.index');
Route::resource('cee-result', CEEResultContoller::class);

//route for report
Route::post('send-cee-exam-slip', [CeeSlipController::class, 'sendExamSlipEmail'])->name('cee.send.exam-slip');
Route::get('cee/exam-slip', [CeeSlipController::class, 'generateceeExamSlip'])->name('cee.exam-slip');

//route for RFC
Route::post('cee/result/rfc-approve/{id}', [RFCCEEScoreController::class, 'approverfc'])->name('cee.result-rfc.approve');
Route::get('cee/result/rfc/{id}/view', [RFCCEEScoreController::class, 'viewdetails'])->name('cee-result.rfc.view');
Route::get('cee/result/rfc/fetch-all', [RFCCEEScoreController::class, 'getData'])->name('cee.rfc.fetch-data');
Route::get('cee/result/rfc', [RFCCEEScoreController::class, 'index'])->name('cee-result-rfc.index');

//route for site settings
Route::resource('cee/site-settings', SiteSettingsController::class);

//route for logs
Route::get('cee/site-logs/fetch-all', [LogsController::class, 'getData'])->name('cee.site-logs-fetch-all-data');
Route::get('cee/site-logs', [LogsController::class, 'index'])->name('cee.site-logs');

Route::get('cee/scan-logs/fetch-all', [ScanLogsController::class, 'getData'])->name('cee.scan-logs-fetch-all-data');
Route::get('cee/scan-logs', [ScanLogsController::class, 'index'])->name('cee.scan-logs');

Route::get('/search', [GlobalSearchController::class, 'search'])->name('search');

//route for room adjustment
Route::put('cee/room-adjust/{id}', [RoomAdjustmentController::class, 'update'])->name('room.adjust.update');
Route::get('cee/room-adjust/{id}/edit', [RoomAdjustmentController::class, 'edit'])->name('room.adjust.edit');
Route::get('cee/rooms-by-session', [RoomAdjustmentController::class, 'getRoomsByExamSession'])->name('rooms.by-exam-session');
Route::get('cee/room-adjustment/get-data', [RoomAdjustmentController::class, 'getData'])->name('cee.room-adjustment.get-data');
Route::get('cee/room-adjustment', [RoomAdjustmentController::class, 'index'])->name('cee.room-adjustment.index');

//routes for view online users
Route::get('cee/online-users', [ViewOnlineUsersController::class, 'index'])->name('cee.online-users.index');
Route::get('cee/online-users/get-data', [ViewOnlineUsersController::class, 'getData'])->name('cee.online-users.data');

//route for users without reservations
Route::get('no-resevation', [NoReservationsController::class, 'index'])->name('user.no-reservation.index');
Route::get('no-reservation/get-data', [NoReservationsController::class, 'getData'])->name('no-reservation.get-data');
Route::get('no-reservation/export', [NoReservationsController::class, 'exportNoReservations'])->name('no-reservation.export');

//route for result template
Route::put('cee/result-template/{id}/update-attachment', [ResultTemplateController::class, 'updateAttachment'])->name('cee.result-template.update-attachment');
Route::put('cee/result-template/{id}', [ResultTemplateController::class, 'update'])->name('cee.result-template.update');
Route::get('cee/result-template/{id}/edit', [ResultTemplateController::class, 'edit'])->name('cee.result-template.edit');
Route::delete('cee/result-template/{id}', [ResultTemplateController::class, 'destroy'])->name('cee.result-template.destroy');
Route::put('cee/result/template/change-status', [ResultTemplateController::class, 'changeStatus'])->name('cee.result-template.change-status');
Route::get('cee/result/template/get-data', [ResultTemplateController::class, 'getData'])->name('cee.result-template.get-data');
Route::post('cee/result/template-save', [ResultTemplateController::class, 'store'])->name('cee.result.template.store');
Route::get('cee/result/template', [ResultTemplateController::class, 'index'])->name('cee.result-template.index');

// route for booklet
Route::post('cee/reservation/booklet-assign-save/', [BookletController::class, 'storefromReservation'])->name('cee.reservation.booklet.store');
Route::get('fetch-app-numbers', [BookletController::class, 'fetchAppNumbers']);
Route::get('cee/booklet/fetch-data', [BookletController::class, 'fetchData'])->name('cee.booklet.fetch-data');
Route::delete('cee/booklet/delete/{id}', [BookletController::class, 'destroy'])->name('cee.booklet.delete');
Route::put('cee/booklet/{id}', [BookletController::class, 'update'])->name('cee.booklet.update');
Route::get('cee/booklet/{id}/edit', [BookletController::class, 'edit'])->name('cee.booklet.edit');
Route::post('cee/booklet-assign-save', [BookletController::class, 'store'])->name('cee.booklet.store');
Route::get('cee/booklet', [BookletController::class, 'index'])->name('cee.booklet.index');


//route for site ettings
Route::put('password/update/{user}', [SiteSettingsController::class, 'updatePassword'])->name('password.update');
Route::put('user/update/{id}', [SiteSettingsController::class, 'updateProfile'])->name('myprofile.update');
Route::get('profile', [SiteSettingsController::class, 'userProfileIndex'])->name('profile.edit');

//count ched complete profiles
Route::get('cee/report/ched-profile/get-data', [ChedProfileReport::class, 'getChedData'])->name('cee.report.ched-profile.index.getdata');
Route::get('cee/report/ched-profile/index', [ChedProfileReport::class, 'ched_profile_report_index'])->name('cee.report.ched-profile.index');
Route::post('cee/ched-applicant-profile/{id}/publish', [ChedProfileReport::class, 'publish'])->name('cee.ched-applicant-profile.publish');
Route::post('cee/ched-profile/save-info', [ChedProfileReport::class, 'store'])->name('cee.ched-profile.store');
Route::get('cee/ched-profile/{id}', [ChedProfileReport::class, 'index'])->name('cee.ched-profile.index');

//route for preregistration
Route::put('pre-registration/program-policy/update/{policyId}', [ProgramController::class, 'updateProgramPolicy'])->name('prereg.program-policy-details.update');
Route::get('pre-registration/program-policy/{policyId}', [ProgramController::class, 'getProgramPolicyDetailsIndex'])->name('prereg.program-policy-details.index');

//download the COR
Route::get('pre-registration/enrolled-applicants/{reg_no}/download-cor', [PreregistrationController::class, 'downloadCOR'])->name('prereg.enrolled-applicants.download-cor');

//route for enrolled applicants
Route::get('pre-registration/enrolled-applicants/{policyId}/index', [PreregistrationController::class, 'enrolledApplicantsIndex'])->name('prereg.enrolled-applicants.index');
Route::get('pre-registration/enrolled-applicants', [PreregistrationController::class, 'enrolledApplicantsSummaryIndex'])->name('prereg.enrolled-applicants-summary.index');
Route::get('pre-registration/enrolled-applicants/data', [PreregistrationController::class, 'getEnrolledApplicantsData'])->name('prereg.enrolled-applicants.data');

//route to see the list of confirmed student per policyId
Route::post('pre-registration/rank-by-policy-id', [PreregistrationController::class, 'rankByPolicyId'])->name('applicant-profile.rank-by-policy-id');

//route for toggle switch for program status
Route::post('pre-registration/toggle-policy/{policyId}', [PreregistrationController::class, 'toggleProgramPolicy'])->name('pre-registration.toggle.policy');

Route::get('pre-registration/export/no-requirements-applicants', [PreregistrationController::class, 'exportNoRequirementsApplicants'])->name('prereg.export.no-requirements-applicants');
Route::get('pre-registration/no-requirements-applicants/list', [PreregistrationController::class, 'getNoRequirementsApplicants'])->name('prereg.no-requirements-applicants-list');
Route::get('pre-registration/no-requirements-applicants', [PreregistrationController::class, 'noRequirementsApplicantsIndex'])->name('prereg.no-requirements-applicants');
Route::get('pre-registration/rank-all', [PreregistrationController::class, 'rankAll'])->name('applicant-profile.rank-all');
Route::get('pre-registration/confirmed-applicants/data', [PreregistrationController::class, 'getConfirmedApplicants'])->name('prereg.confirmed-applicants-getdata');
Route::get('pre-registration/confirmed-applicants/{policyId}/view', [PreregistrationController::class, 'confirmedApplicantsIndex'])->name('prereg.show.confirmed-applicants');
Route::put('pre-registration/student-profile/update/{id}', [PreregistrationController::class, 'updateNstp'])->name('applicant-profile.nstp.update');
Route::get('pre-registration/student-profile/{id}/edit', [PreregistrationController::class, 'editNstp'])->name('applicant-profile.nstp.edit');
Route::get('prereg/applicants-for-ranking/get-data', [PreregistrationController::class, 'getListForRanking'])->name('prereg.applicant-for-ranking.get-data');
Route::get('prereg/applicants/rank/view/{policyId}', [PreregistrationController::class, 'viewRank'])->name('applicants.rank.view');
Route::get('prereg/pending/list', [PreregistrationController::class, 'index'])->name('prereg.pending.index');
Route::get('prereg/pending/data', [PreregistrationController::class, 'getData'])->name('prereg.pending.data');
Route::patch('/prereg/pending/{id}/cancel', [PreregistrationController::class, 'cancelConfirmation'])->name('prereg.pending.cancel');
Route::get('/prereg/pending/requirements/{id}', [PreregistrationController::class, 'getRequirements'])->name('prereg.pending.getRequirements');
Route::post('/prereg/pending/requirements/save', [PreregistrationController::class, 'saveRequirements'])->name('prereg.pending.requirements.save');
Route::get('preregistration', [PreregistrationController::class, 'preregDashboard'])->name('preregistration.dashboard');

//route for preregprofile
//save profile
Route::post('pre-registration/add-applicant/save', [PreregProfileController::class, 'addProfileSave'])->name('add-applicant-profile.save');

//get the
Route::get('pre-registration/add-applicant/get-user-data/{id}', [PreregProfileController::class, 'getUserData'])->name('add-applicant-profile.get-data');
Route::get('pre-registration/add-applicant', [PreregProfileController::class, 'addApplicantIndex'])->name('add-applicant-profile.index');
Route::get('pre-registration/student-profile/{id}/step5', [PreregProfileController::class, 'showStep5'])->name('applicant-profile.step5.show');
Route::post('pre-registration/student-profile/{id}/publish', [PreregProfileController::class, 'publish'])->name('student-profile.publish');
Route::post('pre-registration/student-profile/{id}/unpost', [PreregProfileController::class, 'unpost'])->name('student-profile.unpost');
Route::post('pre-registration/student-profile/step4', [PreregProfileController::class, 'postStep4'])->name('applicant-profile.step4.save');
Route::get('pre-registration/student-profile/{id}/step4', [PreregProfileController::class, 'showStep4'])->name('applicant-profile.step4.show');
Route::post('pre-registration/student-profile/step3', [PreregProfileController::class, 'postStep3'])->name('applicant-profile.step3.save');
Route::get('pre-registration/student-profile/{id}/step3', [PreregProfileController::class, 'showStep3'])->name('applicant-profile.step3.show');
Route::post('pre-registration/student-profile/step2', [PreregProfileController::class, 'postStep2'])->name('applicant-profile.step2.save');
Route::get('pre-registration/student-profile/{id}/step2', [PreregProfileController::class, 'showStep2'])->name('applicant-profile.step2.show');
Route::post('pre-registration/student-profile/step1', [PreregProfileController::class, 'postStep1'])->name('applicant-profile.step1.save');
Route::get('pre-registration/student-profile/{id}/step1', [PreregProfileController::class, 'showStep1'])->name('applicant-profile.step1.show');

//route for view programs
Route::get('pre-registration/programs/get-data', [ProgramController::class, 'getData'])->name('prereg.programs.get-programs');
Route::get('pre-registration/programs', [ProgramController::class, 'index'])->name('prereg.programs.index');

//route for prereg term
Route::put('pre-registration/term-settings/change-status', [PreregTermController::class, 'changeStatus'])->name('prereg-term.settings.change-status');
Route::get('pre-registration/term-settings/data', [PreregTermController::class, 'getData'])->name('prereg-term.settings.data');
Route::resource('pre-registration/term-settings', PreregTermController::class)->names('prereg-term.settings');

//routes for analytics

//export to excel school results per subject area
Route::get('analytics/export-school-results', [AnalyticsController::class, 'exportSchoolResults'])->name('export.school.result-per-subject-area');
//route for cee score distribution per school
Route::get('analytics/score-distribution/{schoolName}', [AnalyticsController::class, 'getScoreDistPerSchoolIndex'])->name('analytics.score-distribution.index');
Route::get('analytics/cee-score-distribution-per-school/{schoolName}', [AnalyticsController::class, 'getScoreDistPerSchool'])->name('analytics.cee-score-distribution-per-school');
Route::get('analytics/cee-score-distribution-overview', [AnalyticsController::class, 'getCeeScoreDistribution'])->name('analytics.cee-score-distribution.index');
Route::get('analytics/cee-overview/school-performance-per-area', [AnalyticsController::class, 'getSchoolPerformancePerArea'])->name('analytics-school-performance-perarea.get-data');
Route::get('analytics/cee-overview/top-school-performer', [AnalyticsController::class, 'gettopschoolCeePassers'])->name('analytics-top-cee.passers');
Route::get('analytics/cee-overview/group-chart', [AnalyticsController::class, 'getReservationGroupChart'])->name('analytics-grouped-chart');
Route::get('analytics/cee-overview/stackedbar', [AnalyticsController::class, 'getReservationStackbar'])->name('analytics-stackbar');
Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// routes for user tagging
Route::get('user/tagging/{id}', [UserController::class, 'UserTagging'])->name('user-tagging.index');
Route::get('user/program-policy', [UserController::class, 'ProgramPolicies'])->name('user.program-policy.index');
Route::get('user/tagging/check-all/{userId}', [UserController::class, 'CheckAllProgramTag'])->name('user.user-tagging.check-all');
Route::delete('user/tagging/remove', [UserController::class, 'RemoveProgramTag'])->name('user.user-tagging.remove');
Route::post('user/tagging/add', [UserController::class, 'AddProgramTag'])->name('user.user-tagging.add');
Route::post('user/tagging/all', [UserController::class, 'AddAllProgramTag'])->name('user.user-tagging.all');
Route::delete('user/tagging/all', [UserController::class, 'RemoveAllProgramTag'])->name('user.user-tagging.all.remove');


//route for PreregAnalytics
Route::get('preregistration/analytics', [PreregAnalyticsController::class, 'index'])->name('preregistration.analytics.index');
Route::get('preregistration/analytics/first_generation_students', [PreregAnalyticsController::class, 'firstGenStudentsStats'])->name('preregistration.analytics.first-generation-students');
Route::get('preregistration/analytics/first_generation_students/details/{termid}', [PreregAnalyticsController::class, 'firstGenStudentsIndex'])->name('preregistration.analytics.first-generation-students.details');
Route::get('preregistration/analytics/sex-orientation-chart', [PreregAnalyticsController::class, 'getSexOrientationChartData'])->name('preregistration.analytics.sex-orientation-chart');
Route::get('preregistration/analytics/pwd-chart', [PreregAnalyticsController::class, 'getPWDChartData'])->name('preregistration.analytics.pwd-chart');
Route::get('preregistration/analytics/ip-chart', [PreregAnalyticsController::class, 'getIPChartData'])->name('preregistration.analytics.ip-chart');


//generate excel report for first generation students
Route::get('preregistration/analytics/first_generation_students/export-excel/{termid}', [PreregAnalyticsController::class, 'exportToExcelFirstGenStudents'])->name('preregistration.analytics.first-generation-students.export-excel');
Route::get('preregistration/analytics/turn-out', [PreregAnalyticsController::class, 'showturnoutprereg'])->name('preregistration.analytics.turn-out');
// route for toggling academic status
Route::post('user/tagging/academic-status', [UserController::class, 'ToggleAcademicStatus'])->name('user.toggle.academic-status');


Route::put('/students/{id}/cancel-confirmation', [PreregistrationController::class, 'cancelNoRequirementsConfirmation'])->name('student.cancel-confirmation.update');

//term
Route::get('term', [TermIDController::class, 'index'])->name('term.index');
Route::put('term-ids/change-status', [TermIDController::class, 'changeStatus'])->name('termid.change-status');
Route::get('term-ids/data', [TermIDController::class, 'getData'])->name('termid.data');

/***
 *
 * PORTAL USERS ROUTES
 */
//routes for Portal Users
Route::put('portal/users/update-password/{id}', [PortalUserController::class, 'storePassword'])->name('portal.password.update');
Route::get('portal/get-all-data', [PortalUserController::class, 'getallUsers'])->name('portal.users.get-all-users');
Route::resource('portal/users', PortalUserController::class)->names('portal.users');

//route for mikrotik requests
Route::get('portal/internet-account-requests/get-all-data', [InternetAccountRequestController::class, 'getallData'])->name('portal.internet-account-requests.get-all-data');
Route::get('portal/internet-account-requests', [InternetAccountRequestController::class, 'index'])->name('portal.internet-account-requests');

//route for Evaluation Requests
Route::get('portal/evaluation-requests/get-all-data', [EvaluationRequestController::class, 'getallData'])->name('portal.evaluation-requests.get-all-data');
Route::resource('portal/evaluation-requests', EvaluationRequestController::class)->names('portal.evaluation-requests');

//route for clearance
Route::get('portal/clearance/{studentId}/fetch-student', [ClearanceController::class, 'getStudent'])->name('portal.clearance.get-student');
Route::patch('portal/clearance/update-clearance-status/{clearance_id}', [ClearanceController::class, 'updateClearanceStatus'])->name('portal.clearance.update-clearance-status');
Route::get('portal/clearance/data', [ClearanceController::class, 'getallData'])->name('portal.clearance.data');
Route::resource('portal/clearance', ClearanceController::class)->names('portal.clearance');
