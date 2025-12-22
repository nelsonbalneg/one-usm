# OpenAPIClient-php

Integration API for multiple legacy systems and web apps


## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ActiveSemestersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2ActiveSemestersActiveOnlyGet();
} catch (Exception $e) {
    echo 'Exception when calling ActiveSemestersApi->apiV2ActiveSemestersActiveOnlyGet: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *http://172.16.0.60/academic*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ActiveSemestersApi* | [**apiV2ActiveSemestersActiveOnlyGet**](docs/Api/ActiveSemestersApi.md#apiv2activesemestersactiveonlyget) | **GET** /api/v2/ActiveSemesters/active-only | 
*ActiveSemestersApi* | [**apiV2ActiveSemestersCampusCampusIdActiveOnlyGet**](docs/Api/ActiveSemestersApi.md#apiv2activesemesterscampuscampusidactiveonlyget) | **GET** /api/v2/ActiveSemesters/campus/{campusId}/active-only | 
*ActiveSemestersApi* | [**apiV2ActiveSemestersGet**](docs/Api/ActiveSemestersApi.md#apiv2activesemestersget) | **GET** /api/v2/ActiveSemesters | 
*ActiveSemestersApi* | [**apiV2ActiveSemestersIdDelete**](docs/Api/ActiveSemestersApi.md#apiv2activesemestersiddelete) | **DELETE** /api/v2/ActiveSemesters/{id} | 
*ActiveSemestersApi* | [**apiV2ActiveSemestersIdPut**](docs/Api/ActiveSemestersApi.md#apiv2activesemestersidput) | **PUT** /api/v2/ActiveSemesters/{id} | 
*ActiveSemestersApi* | [**apiV2ActiveSemestersPost**](docs/Api/ActiveSemestersApi.md#apiv2activesemesterspost) | **POST** /api/v2/ActiveSemesters | 
*ActiveSemestersApi* | [**getActiveTerm**](docs/Api/ActiveSemestersApi.md#getactiveterm) | **GET** /api/v2/ActiveSemesters/{id} | Get the a specific ActiveTerm based on Id.
*AlignEnrolmentApi* | [**apiV2AlignEnrolmentResetApplicationPut**](docs/Api/AlignEnrolmentApi.md#apiv2alignenrolmentresetapplicationput) | **PUT** /api/v2/AlignEnrolment/reset-application | 
*AuthApi* | [**apiV2AuthLoginPost**](docs/Api/AuthApi.md#apiv2authloginpost) | **POST** /api/v2/Auth/login | 
*AuthApi* | [**apiV2AuthRegisterPost**](docs/Api/AuthApi.md#apiv2authregisterpost) | **POST** /api/v2/Auth/register | 
*AuthApi* | [**apiV2AuthTokenStudentNoCampusIdPost**](docs/Api/AuthApi.md#apiv2authtokenstudentnocampusidpost) | **POST** /api/v2/Auth/token/{studentNo}/{campusId} | 
*AyTermConfigsApi* | [**apiV2AyTermConfigsGetAYTermConfigTermIdCampusCampusIdGet**](docs/Api/AyTermConfigsApi.md#apiv2aytermconfigsgetaytermconfigtermidcampuscampusidget) | **GET** /api/v2/AyTermConfigs/GetAYTermConfig/{termId}/campus/{campusId} | 
*AyTermConfigsApi* | [**apiV2AyTermConfigsListGet**](docs/Api/AyTermConfigsApi.md#apiv2aytermconfigslistget) | **GET** /api/v2/AyTermConfigs/list | 
*AyTermConfigsApi* | [**apiV2AyTermConfigsListViewGet**](docs/Api/AyTermConfigsApi.md#apiv2aytermconfigslistviewget) | **GET** /api/v2/AyTermConfigs/list-view | 
*AyTermConfigsApi* | [**getAyTermConfigs**](docs/Api/AyTermConfigsApi.md#getaytermconfigs) | **GET** /api/v2/AyTermConfigs/term/{termId} | 
*AyTermsApi* | [**apiV2AyTermsGetAYTermConfigTermIdCampusCampusIdGet**](docs/Api/AyTermsApi.md#apiv2aytermsgetaytermconfigtermidcampuscampusidget) | **GET** /api/v2/AyTerms/GetAYTermConfig/{termId}/campus/{campusId} | 
*AyTermsApi* | [**apiV2AyTermsListGet**](docs/Api/AyTermsApi.md#apiv2aytermslistget) | **GET** /api/v2/AyTerms/list | 
*AyTermsApi* | [**apiV2AyTermsListViewGet**](docs/Api/AyTermsApi.md#apiv2aytermslistviewget) | **GET** /api/v2/AyTerms/list-view | 
*AyTermsApi* | [**getAyTerms**](docs/Api/AyTermsApi.md#getayterms) | **GET** /api/v2/AyTerms/{id} | 
*CampusApi* | [**apiV2CampusListGet**](docs/Api/CampusApi.md#apiv2campuslistget) | **GET** /api/v2/Campus/list | 
*CampusApi* | [**getCampus**](docs/Api/CampusApi.md#getcampus) | **GET** /api/v2/Campus/{id} | 
*CeeApi* | [**apiV2CeeCommitRankingListByPolicyPolicyIdGet**](docs/Api/CeeApi.md#apiv2ceecommitrankinglistbypolicypolicyidget) | **GET** /api/v2/Cee/commit-ranking-list-by-policy/{policyId} | Displays list of applicants ranked on CSA, Part 1, then Part 2
*CeeApi* | [**apiV2CeeGetListGet**](docs/Api/CeeApi.md#apiv2ceegetlistget) | **GET** /api/v2/Cee/get-list | 
*CeeApi* | [**apiV2CeeGetRankedListByPolicyPolicyIdGet**](docs/Api/CeeApi.md#apiv2ceegetrankedlistbypolicypolicyidget) | **GET** /api/v2/Cee/get-ranked-list-by-policy/{policyId} | Displays list of applicants ranked on CSA, Part 1, then Part 2
*CeeApi* | [**apiV2CeeRankApplicantsForAllPoliciesByTermsPost**](docs/Api/CeeApi.md#apiv2ceerankapplicantsforallpoliciesbytermspost) | **POST** /api/v2/Cee/rank-applicants-for-all-policies-by-terms | 
*CeeApi* | [**apiV2CeeResetApplicantAppNoPost**](docs/Api/CeeApi.md#apiv2ceeresetapplicantappnopost) | **POST** /api/v2/Cee/reset-applicant/{appNo} | 
*CeeApi* | [**apiV2CeeResultByApplicant2ndPriorityApplicantIdGet**](docs/Api/CeeApi.md#apiv2ceeresultbyapplicant2ndpriorityapplicantidget) | **GET** /api/v2/Cee/result-by-applicant-2nd-priority/{applicantId} | Use this for the 2nd priority. Programs are based on specialization kung pasado xa at may bakante pa.
*CeeApi* | [**apiV2CeeResultByApplicant3rdPriorityApplicantIdGet**](docs/Api/CeeApi.md#apiv2ceeresultbyapplicant3rdpriorityapplicantidget) | **GET** /api/v2/Cee/result-by-applicant-3rd-priority/{applicantId} | Use this if program selection is based on CSA cutoff regardless of specialization.
*CeeApi* | [**apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet**](docs/Api/CeeApi.md#apiv2ceeresultbyapplicantallowedtecwithrankingapplicantidget) | **GET** /api/v2/Cee/result-by-applicant-allowed-tec-with-ranking/{applicantId} | Pwede na tumawid ang SEM, BAM at HED sa TEC also added if a program is ranked
*CeeApi* | [**apiV2CeeResultByApplicantApplicantIdGet**](docs/Api/CeeApi.md#apiv2ceeresultbyapplicantapplicantidget) | **GET** /api/v2/Cee/result-by-applicant/{applicantId} | Endpoint for First Priority only.
*CeeApi* | [**apiV2CeeStudentsAppNoGet**](docs/Api/CeeApi.md#apiv2ceestudentsappnoget) | **GET** /api/v2/Cee/students/{appNo} | 
*CeeApi* | [**apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet**](docs/Api/CeeApi.md#apiv2ceetotalsrealcampusrealcampusidtermtermidget) | **GET** /api/v2/Cee/totals/real-campus/{realCampusId}/term/{termId} | Reservation Totals (Real Campus)
*CivilStatusApi* | [**apiV2CivilStatusListGet**](docs/Api/CivilStatusApi.md#apiv2civilstatuslistget) | **GET** /api/v2/CivilStatus/list | 
*CivilStatusApi* | [**getCiviStatus**](docs/Api/CivilStatusApi.md#getcivistatus) | **GET** /api/v2/CivilStatus/{id} | 
*ClassSchedulesApi* | [**apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet**](docs/Api/ClassSchedulesApi.md#apiv2classschedulesgetallfacultyforevalregregidget) | **GET** /api/v2/ClassSchedules/get-all-faculty-for-eval/reg/{regId} | 
*ClassSchedulesApi* | [**apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet**](docs/Api/ClassSchedulesApi.md#apiv2classschedulesgetschedulebysubjecttermtermidsubjectsubjectidget) | **GET** /api/v2/ClassSchedules/get-schedule-by-subject/term/{termId}/subject/{subjectId} | 
*ClassSchedulesApi* | [**apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet**](docs/Api/ClassSchedulesApi.md#apiv2classschedulesgetschedulesbysectiontermidsectionidget) | **GET** /api/v2/ClassSchedules/get-schedules-by-section/{termId}/{sectionId} | 
*ClassSectionsApi* | [**apiV2ClassSectionsByProgramTermTermIdProgramProgramIdGet**](docs/Api/ClassSectionsApi.md#apiv2classsectionsbyprogramtermtermidprogramprogramidget) | **GET** /api/v2/ClassSections/by-program/term/{termId}/program/{programId} | Formerly - bycampusandprogram/{campusId}/term/{termId}/program/{programId}
*ClassSectionsApi* | [**apiV2ClassSectionsCampusCampusIdSectionSectionIdGet**](docs/Api/ClassSectionsApi.md#apiv2classsectionscampuscampusidsectionsectionidget) | **GET** /api/v2/ClassSections/campus/{campusId}/section/{sectionId} | 
*ClassSectionsApi* | [**apiV2ClassSectionsCampusCampusIdTermTermIdGet**](docs/Api/ClassSectionsApi.md#apiv2classsectionscampuscampusidtermtermidget) | **GET** /api/v2/ClassSections/campus/{campusId}/term/{termId} | 
*ClassSectionsApi* | [**apiV2ClassSectionsIdGet**](docs/Api/ClassSectionsApi.md#apiv2classsectionsidget) | **GET** /api/v2/ClassSections/{id} | 
*ClassSectionsApi* | [**apiV2ClassSectionsTermTermIdProgramProgramIdGet**](docs/Api/ClassSectionsApi.md#apiv2classsectionstermtermidprogramprogramidget) | **GET** /api/v2/ClassSections/term/{termId}/program/{programId} | 
*CollegeApi* | [**apiV2CollegeListGet**](docs/Api/CollegeApi.md#apiv2collegelistget) | **GET** /api/v2/College/list | 
*CollegeApi* | [**getCollege**](docs/Api/CollegeApi.md#getcollege) | **GET** /api/v2/College/{id} | 
*CurriculumsApi* | [**apiV2CurriculumsFilterByPolicyIdPolicyIdGet**](docs/Api/CurriculumsApi.md#apiv2curriculumsfilterbypolicyidpolicyidget) | **GET** /api/v2/Curriculums/filter/by-policyId/{policyId} | Filter curriculums by policyId
*CurriculumsApi* | [**apiV2CurriculumsFilterProgramProgramIdGet**](docs/Api/CurriculumsApi.md#apiv2curriculumsfilterprogramprogramidget) | **GET** /api/v2/Curriculums/filter/program/{programId} | Filter by campus and program
*CurriculumsApi* | [**apiV2CurriculumsListGet**](docs/Api/CurriculumsApi.md#apiv2curriculumslistget) | **GET** /api/v2/Curriculums/list | 
*DashboardApi* | [**apiV2DashboardProgramsGet**](docs/Api/DashboardApi.md#apiv2dashboardprogramsget) | **GET** /api/v2/Dashboard/programs | 
*DisciplineMajorsApi* | [**apiV2DisciplineMajorsIdGet**](docs/Api/DisciplineMajorsApi.md#apiv2disciplinemajorsidget) | **GET** /api/v2/DisciplineMajors/{id} | 
*DisciplineMajorsApi* | [**apiV2DisciplineMajorsListGet**](docs/Api/DisciplineMajorsApi.md#apiv2disciplinemajorslistget) | **GET** /api/v2/DisciplineMajors/list | 
*EconCancelsApi* | [**apiV2EconCancelsPost**](docs/Api/EconCancelsApi.md#apiv2econcancelspost) | **POST** /api/v2/EconCancels | 
*EconCancelsApi* | [**getEconCancel**](docs/Api/EconCancelsApi.md#geteconcancel) | **GET** /api/v2/EconCancels/{id} | 
*EconUsersApi* | [**apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet**](docs/Api/EconUsersApi.md#apiv2econusersemployeeidprogrampoliciescampuscampusidget) | **GET** /api/v2/EconUsers/{employeeId}/programPolicies/campus/{campusId} | Get all programs under the employee
*EconUsersApi* | [**apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet**](docs/Api/EconUsersApi.md#apiv2econusersemployeeidprogrampoliciestenanttenantidget) | **GET** /api/v2/EconUsers/{employeeId}/programPolicies/tenant/{tenantId} | 
*EconUsersApi* | [**apiV2EconUsersLoginPost**](docs/Api/EconUsersApi.md#apiv2econusersloginpost) | **POST** /api/v2/EconUsers/login | 
*FacultyEvaluationsApi* | [**apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet**](docs/Api/FacultyEvaluationsApi.md#apiv2facultyevaluationscampuscampusidtermtermidstudentstudentnoget) | **GET** /api/v2/FacultyEvaluations/campus/{campusId}/term/{termId}/student/{studentNo} | 
*GenerateEmailApi* | [**apiV2GenerateEmailGet**](docs/Api/GenerateEmailApi.md#apiv2generateemailget) | **GET** /api/v2/GenerateEmail | 
*GenerateEmailApi* | [**apiV2GenerateEmailRegenEmailPost**](docs/Api/GenerateEmailApi.md#apiv2generateemailregenemailpost) | **POST** /api/v2/GenerateEmail/regen-email | 
*GenerateEmailApi* | [**apiV2GenerateEmailRegenEmailStudentNoRepsPost**](docs/Api/GenerateEmailApi.md#apiv2generateemailregenemailstudentnorepspost) | **POST** /api/v2/GenerateEmail/regen-email/{studentNo}/{reps} | 
*GradesApi* | [**apiV2GradesStudentreportStudentNoGet**](docs/Api/GradesApi.md#apiv2gradesstudentreportstudentnoget) | **GET** /api/v2/Grades/studentreport/{studentNo} | 
*GradesFacultyApi* | [**apiV2GradesFacultyFacultyloadEmpNoGet**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultyfacultyloadempnoget) | **GET** /api/v2/GradesFaculty/facultyload/{EmpNo} | 
*GradesFacultyApi* | [**apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultygradingsheetbyschedulescheduleidtermtermidget) | **GET** /api/v2/GradesFaculty/gradingsheetbyschedule/{scheduleId}/term/{termId} | 
*GradesFacultyApi* | [**apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultygradingsheetposteddatescheduleidtermtermidget) | **GET** /api/v2/GradesFaculty/gradingsheetposteddate/{scheduleId}/term/{termId} | 
*GradesFacultyApi* | [**apiV2GradesFacultyGradingsystemProgClassIDGet**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultygradingsystemprogclassidget) | **GET** /api/v2/GradesFaculty/gradingsystem/{ProgClassID} | 
*GradesFacultyApi* | [**apiV2GradesFacultyGradingsystemsettingsProgClassIDGet**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultygradingsystemsettingsprogclassidget) | **GET** /api/v2/GradesFaculty/gradingsystemsettings/{ProgClassID} | 
*GradesFacultyApi* | [**apiV2GradesFacultyPost**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultypost) | **POST** /api/v2/GradesFaculty | 
*GradesFacultyApi* | [**apiV2GradesFacultyPostgradingsheetPut**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultypostgradingsheetput) | **PUT** /api/v2/GradesFaculty/postgradingsheet | 
*GradesFacultyApi* | [**apiV2GradesFacultyUpdateStudentFinalGradePut**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultyupdatestudentfinalgradeput) | **PUT** /api/v2/GradesFaculty/update-student-final-grade | 
*GradesFacultyApi* | [**apiV2GradesFacultyUpdateStudentMidtermPut**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultyupdatestudentmidtermput) | **PUT** /api/v2/GradesFaculty/update-student-midterm | 
*GradesFacultyApi* | [**apiV2GradesFacultyUpdategradeofstudentPut**](docs/Api/GradesFacultyApi.md#apiv2gradesfacultyupdategradeofstudentput) | **PUT** /api/v2/GradesFaculty/updategradeofstudent | 
*GrantTemplatesApi* | [**apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet**](docs/Api/GrantTemplatesApi.md#apiv2granttemplatesbyschoprovideridandtermidschoprovideridtermidget) | **GET** /api/v2/GrantTemplates/by-scho-provider-id-and-term-id/{schoproviderId}/{termId} | 
*HrEmployeesApi* | [**apiV2HrEmployeesUserIdPut**](docs/Api/HrEmployeesApi.md#apiv2hremployeesuseridput) | **PUT** /api/v2/HrEmployees/{userId} | 
*NationalitiesApi* | [**apiV2NationalitiesListGet**](docs/Api/NationalitiesApi.md#apiv2nationalitieslistget) | **GET** /api/v2/Nationalities/list | 
*NationalitiesApi* | [**getNationality**](docs/Api/NationalitiesApi.md#getnationality) | **GET** /api/v2/Nationalities/{id} | 
*PlacesApi* | [**apiV2PlacesAllregionsGet**](docs/Api/PlacesApi.md#apiv2placesallregionsget) | **GET** /api/v2/Places/allregions | 
*PlacesApi* | [**apiV2PlacesBarangaysincityCityCodeGet**](docs/Api/PlacesApi.md#apiv2placesbarangaysincitycitycodeget) | **GET** /api/v2/Places/barangaysincity/{cityCode} | 
*PlacesApi* | [**apiV2PlacesCitiesinprovinceProvinceCodeGet**](docs/Api/PlacesApi.md#apiv2placescitiesinprovinceprovincecodeget) | **GET** /api/v2/Places/citiesinprovince/{provinceCode} | 
*PlacesApi* | [**apiV2PlacesProvincesinregionRegionCodeGet**](docs/Api/PlacesApi.md#apiv2placesprovincesinregionregioncodeget) | **GET** /api/v2/Places/provincesinregion/{regionCode} | 
*PlacesApi* | [**apiV2PlacesSearchcodeCodeGet**](docs/Api/PlacesApi.md#apiv2placessearchcodecodeget) | **GET** /api/v2/Places/searchcode/{code} | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsGetListGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistsgetlistget) | **GET** /api/v2/PreregWaitingLists/get-list | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsNameAppNumberAppNumberGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistsnameappnumberappnumberget) | **GET** /api/v2/PreregWaitingLists/name/app-number/{appNumber} | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistsnamespolicyidpolicyidget) | **GET** /api/v2/PreregWaitingLists/names/policyId/{policyId} | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistsnamesrealcampusrealcampusidtermtermidget) | **GET** /api/v2/PreregWaitingLists/names/real-campus/{realCampusId}/term/{termId} | Names of applicants in waitlist
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistsnamestermidtermidrealcampusidrealcampusidcollegecollegeidget) | **GET** /api/v2/PreregWaitingLists/names/termId/{termId}/realCampusId/{realCampusId}/college/{collegeId} | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsPost**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistspost) | **POST** /api/v2/PreregWaitingLists | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistspreregnamesrealcampusrealcampusidtermtermidget) | **GET** /api/v2/PreregWaitingLists/pre-regnames/real-campus/{realCampusId}/term/{termId} | Names of applicants in pre-reg
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistspreregtotalsrealcampusrealcampusidtermtermidget) | **GET** /api/v2/PreregWaitingLists/prereg-totals/real-campus/{realCampusId}/term/{termId} | Pre-registration Totals
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsRealCampusesGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitinglistsrealcampusesget) | **GET** /api/v2/PreregWaitingLists/real-campuses | 
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitingliststotalscampuscampusidtermtermidget) | **GET** /api/v2/PreregWaitingLists/totals/campus/{campusId}/term/{termId} | Reservation Totals
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitingliststotalspolicyidpolicyidget) | **GET** /api/v2/PreregWaitingLists/totals/policyId/{policyId} | Reservation total per policy
*PreregWaitingListsApi* | [**apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet**](docs/Api/PreregWaitingListsApi.md#apiv2preregwaitingliststotalsrealcampusrealcampusidtermtermidget) | **GET** /api/v2/PreregWaitingLists/totals/real-campus/{realCampusId}/term/{termId} | Reservation Totals (Real Campus)
*ProgramClassessApi* | [**apiV2ProgramClassessAllGet**](docs/Api/ProgramClassessApi.md#apiv2programclassessallget) | **GET** /api/v2/ProgramClassess/all | 
*ProgramMajorsApi* | [**apiV2ProgramMajorsFilterGet**](docs/Api/ProgramMajorsApi.md#apiv2programmajorsfilterget) | **GET** /api/v2/ProgramMajors/filter | 
*ProgramMajorsApi* | [**apiV2ProgramMajorsIdGet**](docs/Api/ProgramMajorsApi.md#apiv2programmajorsidget) | **GET** /api/v2/ProgramMajors/{id} | 
*ProgramMajorsApi* | [**apiV2ProgramMajorsProgramProgramIdGet**](docs/Api/ProgramMajorsApi.md#apiv2programmajorsprogramprogramidget) | **GET** /api/v2/ProgramMajors/program/{programId} | 
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciescollegecollegeidtermtermidget) | **GET** /api/v2/ProgramPolicies/college/{collegeId}/term/{termId} | Filter by college and term
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciescounterbycollegecollegeidcampuscampusidtermtermidprogramprogramidget) | **GET** /api/v2/ProgramPolicies/counterbycollege/{collegeId}/campus/{campusId}/term/{termId}/program/{programId} | Counts the total slots per program
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesExistsGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesexistsget) | **GET** /api/v2/ProgramPolicies/exists | Check if a policy already exists
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesFilterGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesfilterget) | **GET** /api/v2/ProgramPolicies/filter | Filter policies based on cee score, gpa, type, progid, or campusname
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesFilterbyceeandcampusGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesfilterbyceeandcampusget) | **GET** /api/v2/ProgramPolicies/filterbyceeandcampus | 
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesGpafilterGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesgpafilterget) | **GET** /api/v2/ProgramPolicies/gpafilter | Filter by gpa
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesIdAddonePost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesidaddonepost) | **POST** /api/v2/ProgramPolicies/{id}/addone | Adds 1 admission to the admitted slot
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesidaddpendingslotsslotstoaddpost) | **POST** /api/v2/ProgramPolicies/{id}/addpendingslots/{slotsToAdd} | Add number of slots for pending limit
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesIdAddslotsSlotsToAddPost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesidaddslotsslotstoaddpost) | **POST** /api/v2/ProgramPolicies/{id}/addslots/{slotsToAdd} | Add 1 to slot limits
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesIdLessonePost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesidlessonepost) | **POST** /api/v2/ProgramPolicies/{id}/lessone | Subtracts 1 to admission count
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesidsubtractpendingslotsslotstosubtractpost) | **POST** /api/v2/ProgramPolicies/{id}/subtractpendingslots/{slotsToSubtract} | subtract pending limits
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesidsubtractslotsslotstosubtractpost) | **POST** /api/v2/ProgramPolicies/{id}/subtractslots/{slotsToSubtract} | Subtract 1 to slot limits
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslistbstermtermidcampuscampusidget) | **GET** /api/v2/ProgramPolicies/list-bs/term/{termId}/campus/{campusId} | Get Bachelor programs
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslistgstermtermidcampuscampusidget) | **GET** /api/v2/ProgramPolicies/list-gs/term/{termId}/campus/{campusId} | Get policies for grad school
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListStatusGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesliststatusget) | **GET** /api/v2/ProgramPolicies/list/status | Total count of applicant status
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListStatusPermunicipalityGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesliststatuspermunicipalityget) | **GET** /api/v2/ProgramPolicies/list/status/permunicipality | Total count per municipality
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslisttermtermidcampuscampusidceeceescoreget) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/campus/{campusId}/cee/{ceeScore} | Filter on first Priority
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslisttermtermidcampuscampusidget) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/campus/{campusId} | Filter by term and campus with totals
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslisttermtermidrealcampusrealcampusidceeceescoreget) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/real-campus/{realCampusId}/cee/{ceeScore} | Filter on real campus id
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslisttermtermidrealcampusrealcampusidget) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/realcampus/{realCampusId} | Filter by term and real campus with totals
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListallGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslistallget) | **GET** /api/v2/ProgramPolicies/listall | List of all policies
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpolicieslistbytermandceetermidceescoreget) | **GET** /api/v2/ProgramPolicies/listbytermandcee/{termId}/{ceeScore} | List of policies by term and cee score
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesPolicyIdRequirehepabtestPut**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciespolicyidrequirehepabtestput) | **PUT** /api/v2/ProgramPolicies/{policyId}/requirehepabtest | Switch for requiring hepa b test
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesPolicyIdSetcutoffscorePut**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciespolicyidsetcutoffscoreput) | **PUT** /api/v2/ProgramPolicies/{policyId}/setcutoffscore | Update cutoff score
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesPolicyIdSetstatusPut**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciespolicyidsetstatusput) | **PUT** /api/v2/ProgramPolicies/{policyId}/setstatus | Update policy status
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesPost**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciespost) | **POST** /api/v2/ProgramPolicies | Create a policy
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesPut**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesput) | **PUT** /api/v2/ProgramPolicies | Update a policy
*ProgramPoliciesApi* | [**apiV2ProgramPoliciesRemainingslotsGet**](docs/Api/ProgramPoliciesApi.md#apiv2programpoliciesremainingslotsget) | **GET** /api/v2/ProgramPolicies/remainingslots | Get the remaining slots
*ProgramPoliciesApi* | [**getPolicy**](docs/Api/ProgramPoliciesApi.md#getpolicy) | **GET** /api/v2/ProgramPolicies/{progPolicyId} | Get a policy by Id
*ProgramsApi* | [**apiV2ProgramsIdGet**](docs/Api/ProgramsApi.md#apiv2programsidget) | **GET** /api/v2/Programs/{id} | 
*ProgramsApi* | [**apiV2ProgramsKccListGraduateprogramsGet**](docs/Api/ProgramsApi.md#apiv2programskcclistgraduateprogramsget) | **GET** /api/v2/Programs/kcc/list/graduateprograms | 
*ProgramsApi* | [**apiV2ProgramsListBycollegeCollegeIdGet**](docs/Api/ProgramsApi.md#apiv2programslistbycollegecollegeidget) | **GET** /api/v2/Programs/list/bycollege/{collegeId} | 
*ProgramsApi* | [**apiV2ProgramsListGet**](docs/Api/ProgramsApi.md#apiv2programslistget) | **GET** /api/v2/Programs/list | 
*ProgramsApi* | [**apiV2ProgramsListGraduateprogramsGet**](docs/Api/ProgramsApi.md#apiv2programslistgraduateprogramsget) | **GET** /api/v2/Programs/list/graduateprograms | 
*RegistrationsApi* | [**apiV2RegistrationsBalanceStudentNoGet**](docs/Api/RegistrationsApi.md#apiv2registrationsbalancestudentnoget) | **GET** /api/v2/Registrations/balance/{studentNo} | Get total student balance
*RegistrationsApi* | [**apiV2RegistrationsBystudentStudentNoTermTermIdGet**](docs/Api/RegistrationsApi.md#apiv2registrationsbystudentstudentnotermtermidget) | **GET** /api/v2/Registrations/bystudent/{studentNo}/term/{termId} | Get student registration record by term
*RegistrationsApi* | [**apiV2RegistrationsCorrectemailsfromgoogletostudentPut**](docs/Api/RegistrationsApi.md#apiv2registrationscorrectemailsfromgoogletostudentput) | **PUT** /api/v2/Registrations/correctemailsfromgoogletostudent | 
*RegistrationsApi* | [**apiV2RegistrationsCorrectemailsofstudentsTermIdPut**](docs/Api/RegistrationsApi.md#apiv2registrationscorrectemailsofstudentstermidput) | **PUT** /api/v2/Registrations/correctemailsofstudents/{termId} | 
*RegistrationsApi* | [**apiV2RegistrationsGetAllRegistrationsStudentNoGet**](docs/Api/RegistrationsApi.md#apiv2registrationsgetallregistrationsstudentnoget) | **GET** /api/v2/Registrations/get-all-registrations/{studentNo} | 
*RegistrationsApi* | [**apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet**](docs/Api/RegistrationsApi.md#apiv2registrationsregidgetstudentstudentnotermtermidget) | **GET** /api/v2/Registrations/{regId}/get-student/{studentNo}/term/{termId} | Verify student registration
*RegistrationsApi* | [**apiV2RegistrationsSchedulesStudentNoTermIdGet**](docs/Api/RegistrationsApi.md#apiv2registrationsschedulesstudentnotermidget) | **GET** /api/v2/Registrations/schedules/{studentNo}/{termId} | get schedules by term and campus
*RegistrationsApi* | [**apiV2RegistrationsStudentAccountabilitiesStudentNoGet**](docs/Api/RegistrationsApi.md#apiv2registrationsstudentaccountabilitiesstudentnoget) | **GET** /api/v2/Registrations/student-accountabilities/{studentNo} | Get all outstanding Accountabilities
*RegistrationsApi* | [**apiV2RegistrationsTermTermIdStudentStudentNoGet**](docs/Api/RegistrationsApi.md#apiv2registrationstermtermidstudentstudentnoget) | **GET** /api/v2/Registrations/term/{termId}/student/{studentNo} | Get student section
*RegistrationsApi* | [**apiV2RegistrationsTotalernrolledTermTermIdGet**](docs/Api/RegistrationsApi.md#apiv2registrationstotalernrolledtermtermidget) | **GET** /api/v2/Registrations/totalernrolled/term/{termId} | Counts all enrolled students based on campus and term
*RegistrationsApi* | [**apiV2RegistrationsYearsofresidencyStudentStudentNoGet**](docs/Api/RegistrationsApi.md#apiv2registrationsyearsofresidencystudentstudentnoget) | **GET** /api/v2/Registrations/yearsofresidency/student/{studentNo} | Counts the number of years
*ReligionsApi* | [**apiV2ReligionsListGet**](docs/Api/ReligionsApi.md#apiv2religionslistget) | **GET** /api/v2/Religions/list | 
*ReligionsApi* | [**getReligion**](docs/Api/ReligionsApi.md#getreligion) | **GET** /api/v2/Religions/{id} | 
*ReportsApi* | [**apiV2ReportsEnrollmentstatusTermTermIdGet**](docs/Api/ReportsApi.md#apiv2reportsenrollmentstatustermtermidget) | **GET** /api/v2/Reports/enrollmentstatus/term/{termId} | 
*ReportsApi* | [**apiV2ReportsTotalernrolledTermTermIdGet**](docs/Api/ReportsApi.md#apiv2reportstotalernrolledtermtermidget) | **GET** /api/v2/Reports/totalernrolled/term/{termId} | 
*ResetStudentApi* | [**apiV2ResetStudentAppNoUserIdPost**](docs/Api/ResetStudentApi.md#apiv2resetstudentappnouseridpost) | **POST** /api/v2/ResetStudent/{appNo}/{userId} | 
*SarApi* | [**apiV2SarGetUserByEmailEmailGet**](docs/Api/SarApi.md#apiv2sargetuserbyemailemailget) | **GET** /api/v2/Sar/get-user-by-email/{email} | Get User by email
*SarAdmissionReqsTaggingsApi* | [**apiV2SarSarAdmissionReqsTaggingsPost**](docs/Api/SarAdmissionReqsTaggingsApi.md#apiv2sarsaradmissionreqstaggingspost) | **POST** /api/v2/sar/SarAdmissionReqsTaggings | Create a new Admission Requirement checklist for a student
*SarAdmissionReqsTaggingsApi* | [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut**](docs/Api/SarAdmissionReqsTaggingsApi.md#apiv2sarsaradmissionreqstaggingsstudentnocampusidcertofgradput) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/cert-of-grad | Update a student&#39;s HS certificate of graduation submission status
*SarAdmissionReqsTaggingsApi* | [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut**](docs/Api/SarAdmissionReqsTaggingsApi.md#apiv2sarsaradmissionreqstaggingsstudentnocampusidform137aput) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/form137a | Update a student&#39;s Form 137a submission status
*SarAdmissionReqsTaggingsApi* | [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put**](docs/Api/SarAdmissionReqsTaggingsApi.md#apiv2sarsaradmissionreqstaggingsstudentnocampusidtagform138put) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/tag-form138 | Update a student&#39;s Form 138 submission status
*SarAdmissionReqsTaggingsApi* | [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut**](docs/Api/SarAdmissionReqsTaggingsApi.md#apiv2sarsaradmissionreqstaggingsstudentnocampusidtagpsaput) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/tag-psa | Update a student&#39;s PSA Birth Certificate submission status
*SarAdmissionReqsTaggingsApi* | [**getAdmissionRequirement**](docs/Api/SarAdmissionReqsTaggingsApi.md#getadmissionrequirement) | **GET** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/campus/{campusId} | 
*SarPermanentTaggingsApi* | [**apiV2SarSarPermanentTaggingsByStudentStudentNoGet**](docs/Api/SarPermanentTaggingsApi.md#apiv2sarsarpermanenttaggingsbystudentstudentnoget) | **GET** /api/v2/sar/SarPermanentTaggings/by-student/{studentNo} | 
*SarPermanentTaggingsApi* | [**apiV2SarSarPermanentTaggingsIdPut**](docs/Api/SarPermanentTaggingsApi.md#apiv2sarsarpermanenttaggingsidput) | **PUT** /api/v2/sar/SarPermanentTaggings/{id} | 
*SarPermanentTaggingsApi* | [**apiV2SarSarPermanentTaggingsPost**](docs/Api/SarPermanentTaggingsApi.md#apiv2sarsarpermanenttaggingspost) | **POST** /api/v2/sar/SarPermanentTaggings | 
*SarPermanentTaggingsApi* | [**getPermanentTagging**](docs/Api/SarPermanentTaggingsApi.md#getpermanenttagging) | **GET** /api/v2/sar/SarPermanentTaggings/{id} | 
*SarSemestralTaggingsApi* | [**apiV2SarSarSemestralTaggingsByStudentStudentNoGet**](docs/Api/SarSemestralTaggingsApi.md#apiv2sarsarsemestraltaggingsbystudentstudentnoget) | **GET** /api/v2/sar/SarSemestralTaggings/by-student/{studentNo} | 
*SarSemestralTaggingsApi* | [**apiV2SarSarSemestralTaggingsIdPut**](docs/Api/SarSemestralTaggingsApi.md#apiv2sarsarsemestraltaggingsidput) | **PUT** /api/v2/sar/SarSemestralTaggings/{id} | 
*SarSemestralTaggingsApi* | [**apiV2SarSarSemestralTaggingsPost**](docs/Api/SarSemestralTaggingsApi.md#apiv2sarsarsemestraltaggingspost) | **POST** /api/v2/sar/SarSemestralTaggings | 
*SarSemestralTaggingsApi* | [**getSemestralTagging**](docs/Api/SarSemestralTaggingsApi.md#getsemestraltagging) | **GET** /api/v2/sar/SarSemestralTaggings/{id} | 
*SarSettingsApi* | [**apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet**](docs/Api/SarSettingsApi.md#apiv2sarsarsettingscurrenttermidcampuscampusidget) | **GET** /api/v2/sar/SarSettings/current-term-id/campus/{campusId} | 
*SarTrialProgramDetailDetailsApi* | [**apiV2SarSarTrialProgramDetailDetailsIdDelete**](docs/Api/SarTrialProgramDetailDetailsApi.md#apiv2sarsartrialprogramdetaildetailsiddelete) | **DELETE** /api/v2/sar/SarTrialProgramDetailDetails/{id} | 
*SarTrialProgramDetailDetailsApi* | [**apiV2SarSarTrialProgramDetailDetailsIdPut**](docs/Api/SarTrialProgramDetailDetailsApi.md#apiv2sarsartrialprogramdetaildetailsidput) | **PUT** /api/v2/sar/SarTrialProgramDetailDetails/{id} | 
*SarTrialProgramDetailDetailsApi* | [**apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut**](docs/Api/SarTrialProgramDetailDetailsApi.md#apiv2sarsartrialprogramdetaildetailsidupdateschedulescheduleidcampuscampusidput) | **PUT** /api/v2/sar/SarTrialProgramDetailDetails/{id}/update-schedule/{scheduleId}/campus/{campusId} | 
*SarTrialProgramDetailDetailsApi* | [**apiV2SarSarTrialProgramDetailDetailsPost**](docs/Api/SarTrialProgramDetailDetailsApi.md#apiv2sarsartrialprogramdetaildetailspost) | **POST** /api/v2/sar/SarTrialProgramDetailDetails | 
*SarTrialProgramDetailDetailsApi* | [**getTrialProgramDetail**](docs/Api/SarTrialProgramDetailDetailsApi.md#gettrialprogramdetail) | **GET** /api/v2/sar/SarTrialProgramDetailDetails/{id} | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsByStudentStudentNoGet**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsbystudentstudentnoget) | **GET** /api/v2/sar/SarTrialPrograms/by-student/{studentNo} | Get the trial program by studentNo
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsbystudentstudentnotermidget) | **GET** /api/v2/sar/SarTrialPrograms/by-student/{studentNo}/{termId} | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramscountallenrolledthroughsarmaintermidkcctermidget) | **GET** /api/v2/sar/SarTrialPrograms/count-all-enrolled-through-sar/{mainTermId}/{kccTermId} | Count of all Enrollments through SAR
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramscountallsarregsmaintermidkcctermidget) | **GET** /api/v2/sar/SarTrialPrograms/countAllSarRegs/{mainTermId}/{kccTermId} | Count all SAR registrations by term
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsDatatablePagedGet**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsdatatablepagedget) | **GET** /api/v2/sar/SarTrialPrograms/datatable/paged | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdCancelPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidcancelput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/cancel | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdEnroll2UserIdPost**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidenroll2useridpost) | **POST** /api/v2/sar/SarTrialPrograms/{id}/enroll2/{userId} | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdEnrollPost**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidenrollpost) | **POST** /api/v2/sar/SarTrialPrograms/{id}/enroll | Enroll the student using TrialProgramId
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileClassSectionPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofileclasssectionput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/class-section | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileCurriculumPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofilecurriculumput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/curriculum | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileGrantTemplatePut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofilegranttemplateput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/grant-template | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofilemaxloadunitmaxloadunitsput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/max-load-unit/{maxLoadUnits} | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileProgramPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofileprogramput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/program | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofileresidencyonlyvalueput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/residency-only/{value} | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileSchoProviderPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofileschoproviderput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/scho-provider | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileTableOfFeePut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofiletableoffeeput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/table-of-fee | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdProfileYearLevelPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidprofileyearlevelput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/year-level | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdSetTransactionTypePost**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidsettransactiontypepost) | **POST** /api/v2/sar/SarTrialPrograms/{id}/set-transaction-type | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsIdSubmitPut**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramsidsubmitput) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/submit | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsPost**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramspost) | **POST** /api/v2/sar/SarTrialPrograms | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsSyncPatch**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramssyncpatch) | **PATCH** /api/v2/sar/SarTrialPrograms/sync | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsSyncTpEnrollmentPatch**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramssynctpenrollmentpatch) | **PATCH** /api/v2/sar/SarTrialPrograms/sync-tp-enrollment | 
*SarTrialProgramsApi* | [**apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch**](docs/Api/SarTrialProgramsApi.md#apiv2sarsartrialprogramssynctpenrollmenttermidpatch) | **PATCH** /api/v2/sar/SarTrialPrograms/sync-tp-enrollment/{termId} | 
*SarTrialProgramsApi* | [**getTrialProgram**](docs/Api/SarTrialProgramsApi.md#gettrialprogram) | **GET** /api/v2/sar/SarTrialPrograms/{id} | 
*SarUsersApi* | [**apiV2SarSarUsersEmployeeIdProgramPoliciesCampusCampusIdGet**](docs/Api/SarUsersApi.md#apiv2sarsarusersemployeeidprogrampoliciescampuscampusidget) | **GET** /api/v2/sar/SarUsers/{employeeId}/programPolicies/campus/{campusId} | Get all programs under the employee
*SarUsersApi* | [**apiV2SarSarUsersLoginPost**](docs/Api/SarUsersApi.md#apiv2sarsarusersloginpost) | **POST** /api/v2/sar/SarUsers/login | 
*SchoProvidersApi* | [**apiV2SchoProvidersGet**](docs/Api/SchoProvidersApi.md#apiv2schoprovidersget) | **GET** /api/v2/SchoProviders | Gets all Scholarship Providers from a tenant.
*SchoProvidersApi* | [**apiV2SchoProvidersIdGetGrantTemplatesTermIdGet**](docs/Api/SchoProvidersApi.md#apiv2schoprovidersidgetgranttemplatestermidget) | **GET** /api/v2/SchoProviders/{id}/get-grant-templates/{termId} | Gets the Grant Templates based on termId
*SchoProvidersApi* | [**apiV2SchoProvidersSchoProviderTypesTermIdGet**](docs/Api/SchoProvidersApi.md#apiv2schoprovidersschoprovidertypestermidget) | **GET** /api/v2/SchoProviders/scho-provider-types/{termId} | Gets the scholarship provider types
*ShiftingRequestsApi* | [**apiV2SarShiftingRequestsByStudentStudentNoGet**](docs/Api/ShiftingRequestsApi.md#apiv2sarshiftingrequestsbystudentstudentnoget) | **GET** /api/v2/sar/ShiftingRequests/by-student/{studentNo} | 
*ShiftingRequestsApi* | [**apiV2SarShiftingRequestsIdPut**](docs/Api/ShiftingRequestsApi.md#apiv2sarshiftingrequestsidput) | **PUT** /api/v2/sar/ShiftingRequests/{id} | 
*ShiftingRequestsApi* | [**apiV2SarShiftingRequestsIdSubmitPut**](docs/Api/ShiftingRequestsApi.md#apiv2sarshiftingrequestsidsubmitput) | **PUT** /api/v2/sar/ShiftingRequests/{id}/submit | 
*ShiftingRequestsApi* | [**apiV2SarShiftingRequestsPost**](docs/Api/ShiftingRequestsApi.md#apiv2sarshiftingrequestspost) | **POST** /api/v2/sar/ShiftingRequests | 
*ShiftingRequestsApi* | [**getShiftingRequest**](docs/Api/ShiftingRequestsApi.md#getshiftingrequest) | **GET** /api/v2/sar/ShiftingRequests/{id} | 
*StudentVaxInfosApi* | [**apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet**](docs/Api/StudentVaxInfosApi.md#apiv2studentvaxinfoscampuscampusidstudentstudentnoget) | **GET** /api/v2/StudentVaxInfos/campus/{campusId}/student/{studentNo} | 
*StudentVaxInfosApi* | [**apiV2StudentVaxInfosIdCampusCampusIdPut**](docs/Api/StudentVaxInfosApi.md#apiv2studentvaxinfosidcampuscampusidput) | **PUT** /api/v2/StudentVaxInfos/{id}/campus/{campusId} | 
*StudentVaxInfosApi* | [**apiV2StudentVaxInfosOncampusCampusIdPost**](docs/Api/StudentVaxInfosApi.md#apiv2studentvaxinfosoncampuscampusidpost) | **POST** /api/v2/StudentVaxInfos/oncampus/{campusId} | 
*StudentVaxInfosApi* | [**apiV2StudentVaxInfosStudentNoCampusCampusIdDelete**](docs/Api/StudentVaxInfosApi.md#apiv2studentvaxinfosstudentnocampuscampusiddelete) | **DELETE** /api/v2/StudentVaxInfos/{studentNo}/campus/{campusId} | 
*StudentVaxInfosApi* | [**apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet**](docs/Api/StudentVaxInfosApi.md#apiv2studentvaxinfosverifystudentstudentnocampuscampusidget) | **GET** /api/v2/StudentVaxInfos/verifystudent/{studentNo}/campus/{campusId} | 
*StudentVaxInfosApi* | [**getVaxInfo**](docs/Api/StudentVaxInfosApi.md#getvaxinfo) | **GET** /api/v2/StudentVaxInfos/{id}/campus/{campusId} | 
*StudentsApi* | [**apiV2StudentsAddStudentToPortalPost**](docs/Api/StudentsApi.md#apiv2studentsaddstudenttoportalpost) | **POST** /api/v2/Students/AddStudentToPortal | 
*StudentsApi* | [**apiV2StudentsAdmitStudentNoValidationPost**](docs/Api/StudentsApi.md#apiv2studentsadmitstudentnovalidationpost) | **POST** /api/v2/Students/admit-student/no-validation | Approve student from econ. Validates if there are still slots
*StudentsApi* | [**apiV2StudentsAdmitStudentPost**](docs/Api/StudentsApi.md#apiv2studentsadmitstudentpost) | **POST** /api/v2/Students/admit-student | Approve student from econ. Validates if there are still slots
*StudentsApi* | [**apiV2StudentsCampusCampusIdGetbyemailEmailGet**](docs/Api/StudentsApi.md#apiv2studentscampuscampusidgetbyemailemailget) | **GET** /api/v2/Students/campus/{campusId}/getbyemail/{email} | 
*StudentsApi* | [**apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet**](docs/Api/StudentsApi.md#apiv2studentscampuscampusidgetbyemailemailtermtermidget) | **GET** /api/v2/Students/campus/{campusId}/getbyemail/{email}/term/{termId} | 
*StudentsApi* | [**apiV2StudentsFilteredbystatusGet**](docs/Api/StudentsApi.md#apiv2studentsfilteredbystatusget) | **GET** /api/v2/Students/filteredbystatus | 
*StudentsApi* | [**apiV2StudentsGeneratenewidGet**](docs/Api/StudentsApi.md#apiv2studentsgeneratenewidget) | **GET** /api/v2/Students/generatenewid | 
*StudentsApi* | [**apiV2StudentsGetemailpasswordGet**](docs/Api/StudentsApi.md#apiv2studentsgetemailpasswordget) | **GET** /api/v2/Students/getemailpassword | 
*StudentsApi* | [**apiV2StudentsGetstudentidGet**](docs/Api/StudentsApi.md#apiv2studentsgetstudentidget) | **GET** /api/v2/Students/getstudentid | Searches all tenant DBs if the student exists
*StudentsApi* | [**apiV2StudentsMismatchedGet**](docs/Api/StudentsApi.md#apiv2studentsmismatchedget) | **GET** /api/v2/Students/mismatched | 
*StudentsApi* | [**apiV2StudentsNoValidationPost**](docs/Api/StudentsApi.md#apiv2studentsnovalidationpost) | **POST** /api/v2/Students/no-validation | 
*StudentsApi* | [**apiV2StudentsPost**](docs/Api/StudentsApi.md#apiv2studentspost) | **POST** /api/v2/Students | 
*StudentsApi* | [**apiV2StudentsPreregStatuscountStatusPolicyIdGet**](docs/Api/StudentsApi.md#apiv2studentspreregstatuscountstatuspolicyidget) | **GET** /api/v2/Students/prereg/statuscount/{status}/{policyId} | 
*StudentsApi* | [**apiV2StudentsRequestemailupdatePut**](docs/Api/StudentsApi.md#apiv2studentsrequestemailupdateput) | **PUT** /api/v2/Students/requestemailupdate | 
*StudentsApi* | [**apiV2StudentsStudentIdDatacompletenessGet**](docs/Api/StudentsApi.md#apiv2studentsstudentiddatacompletenessget) | **GET** /api/v2/Students/{studentId}/datacompleteness | 
*StudentsApi* | [**apiV2StudentsStudentIdPut**](docs/Api/StudentsApi.md#apiv2studentsstudentidput) | **PUT** /api/v2/Students/{studentId} | 
*StudentsApi* | [**apiV2StudentsValidateregistrationGet**](docs/Api/StudentsApi.md#apiv2studentsvalidateregistrationget) | **GET** /api/v2/Students/validateregistration | 
*StudentsApi* | [**apiV2StudentsVerifyineslocalGet**](docs/Api/StudentsApi.md#apiv2studentsverifyineslocalget) | **GET** /api/v2/Students/verifyineslocal | 
*StudentsApi* | [**apiV2StudentsWithauthPost**](docs/Api/StudentsApi.md#apiv2studentswithauthpost) | **POST** /api/v2/Students/withauth | 
*StudentsApi* | [**getStudent**](docs/Api/StudentsApi.md#getstudent) | **GET** /api/v2/Students/{id} | 
*StudentsApi* | [**getStudentByIdAndTenant**](docs/Api/StudentsApi.md#getstudentbyidandtenant) | **GET** /api/v2/Students/{id}/tenant | 
*SubjectScheduleApi* | [**apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet**](docs/Api/SubjectScheduleApi.md#apiv2subjectschedulecampuscampusidschedschedidtermtermidget) | **GET** /api/v2/SubjectSchedule/campus/{campusId}/sched/{schedId}/term/{termId} | 
*SubjectScheduleApi* | [**apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet**](docs/Api/SubjectScheduleApi.md#apiv2subjectschedulecurriculumstudentstudentidcampuscampusidtermtermidget) | **GET** /api/v2/SubjectSchedule/curriculum/student/{studentId}/campus/{campusId}/term/{termId} | 
*SubjectScheduleApi* | [**apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet**](docs/Api/SubjectScheduleApi.md#apiv2subjectschedulesectionssectionidcampuscampusidtermtermidget) | **GET** /api/v2/SubjectSchedule/sections/{sectionId}/campus/{campusId}/term/{termId} | 
*SubjectScheduleApi* | [**apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet**](docs/Api/SubjectScheduleApi.md#apiv2subjectschedulesubjectidcampuscampusidtermtermidget) | **GET** /api/v2/SubjectSchedule/{subjectId}/campus/{campusId}/term/{termId} | 
*TableOfFeesApi* | [**apiV2TableOfFeesCampusCampusIdTermTermIdGet**](docs/Api/TableOfFeesApi.md#apiv2tableoffeescampuscampusidtermtermidget) | **GET** /api/v2/TableOfFees/campus/{campusId}/term/{termId} | 
*TableOfFeesApi* | [**apiV2TableOfFeesTermTermIdGet**](docs/Api/TableOfFeesApi.md#apiv2tableoffeestermtermidget) | **GET** /api/v2/TableOfFees/term/{termId} | 
*TransactionLogsApi* | [**apiV2TransactionLogsKccPost**](docs/Api/TransactionLogsApi.md#apiv2transactionlogskccpost) | **POST** /api/v2/TransactionLogs/kcc | 
*TransactionLogsApi* | [**apiV2TransactionLogsPost**](docs/Api/TransactionLogsApi.md#apiv2transactionlogspost) | **POST** /api/v2/TransactionLogs | 
*TransactionLogsApi* | [**getLog**](docs/Api/TransactionLogsApi.md#getlog) | **GET** /api/v2/TransactionLogs/{logId} | 
*TransactionLogsApi* | [**getLogKcc**](docs/Api/TransactionLogsApi.md#getlogkcc) | **GET** /api/v2/TransactionLogs/kcc/{logId} | 
*TrialProgramApi* | [**apiV2TrialProgramCurriculumStudentStudentIdGet**](docs/Api/TrialProgramApi.md#apiv2trialprogramcurriculumstudentstudentidget) | **GET** /api/v2/TrialProgram/curriculum/student/{studentId} | Curriculum view for adviser
*TrialProgramApi* | [**apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet**](docs/Api/TrialProgramApi.md#apiv2trialprogramcurriculumstudentstudentidtermtermidget) | **GET** /api/v2/TrialProgram/curriculum/student/{studentId}/term/{termId} | Curriculum view for student
*TrialProgramApi* | [**apiV2TrialProgramEvaluationStudentStudentIdGet**](docs/Api/TrialProgramApi.md#apiv2trialprogramevaluationstudentstudentidget) | **GET** /api/v2/TrialProgram/evaluation/student/{studentId} | Evaluation view for adviser
*TrialProgramApi* | [**apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet**](docs/Api/TrialProgramApi.md#apiv2trialprogramgetstudentsbysectionsectionidtermidget) | **GET** /api/v2/TrialProgram/getstudentsbysection/{sectionId}/{termId} | 
*TrialProgramApi* | [**apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet**](docs/Api/TrialProgramApi.md#apiv2trialprogramgetstudentstreebycampuscampusidprevioustermidget) | **GET** /api/v2/TrialProgram/getstudentstreebycampus/{campusId}/{previousTermId} | 
*TrialProgramApi* | [**apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet**](docs/Api/TrialProgramApi.md#apiv2trialprogramstudentstudentidtermcurrenttermidget) | **GET** /api/v2/TrialProgram/student/{studentId}/term/{currentTermId} | 
*TribesApi* | [**apiV2TribesListGet**](docs/Api/TribesApi.md#apiv2tribeslistget) | **GET** /api/v2/Tribes/list | 
*TribesApi* | [**getTribes**](docs/Api/TribesApi.md#gettribes) | **GET** /api/v2/Tribes/{id} | 
*YearLevelApi* | [**apiV2YearLevelListGet**](docs/Api/YearLevelApi.md#apiv2yearlevellistget) | **GET** /api/v2/YearLevel/list | 
*YearLevelApi* | [**getYearLevel**](docs/Api/YearLevelApi.md#getyearlevel) | **GET** /api/v2/YearLevel/{id} | 

## Models

- [ActiveTermDto](docs/Model/ActiveTermDto.md)
- [AdmissionRequirementDto](docs/Model/AdmissionRequirementDto.md)
- [AlignEnrolmentDto](docs/Model/AlignEnrolmentDto.md)
- [ApproveApplicantDto](docs/Model/ApproveApplicantDto.md)
- [CeeStudentDto](docs/Model/CeeStudentDto.md)
- [CreateEconCancelDto](docs/Model/CreateEconCancelDto.md)
- [GradesDto](docs/Model/GradesDto.md)
- [PermanentTaggingDto](docs/Model/PermanentTaggingDto.md)
- [PolicyControllerRequireHepaTestDto](docs/Model/PolicyControllerRequireHepaTestDto.md)
- [PolicyControllerSetCutOffScoreDto](docs/Model/PolicyControllerSetCutOffScoreDto.md)
- [PolicyControllerSetStatusDto](docs/Model/PolicyControllerSetStatusDto.md)
- [ProgramPolicyDto](docs/Model/ProgramPolicyDto.md)
- [PutHrEmployeeDto](docs/Model/PutHrEmployeeDto.md)
- [QualifiedProgramDto](docs/Model/QualifiedProgramDto.md)
- [QualifiedProgramsView](docs/Model/QualifiedProgramsView.md)
- [QualifiedRealCampusDto](docs/Model/QualifiedRealCampusDto.md)
- [QualifiedRealCampusView](docs/Model/QualifiedRealCampusView.md)
- [RequestStudentValidationDto](docs/Model/RequestStudentValidationDto.md)
- [ReservationDto](docs/Model/ReservationDto.md)
- [ResultByApplicantDto](docs/Model/ResultByApplicantDto.md)
- [ResultByApplicantView](docs/Model/ResultByApplicantView.md)
- [SarProfileUpdateInput](docs/Model/SarProfileUpdateInput.md)
- [SemestralTaggingDto](docs/Model/SemestralTaggingDto.md)
- [SetTrialProgramTransTypeInput](docs/Model/SetTrialProgramTransTypeInput.md)
- [ShiftingRequestDto](docs/Model/ShiftingRequestDto.md)
- [StudentDto](docs/Model/StudentDto.md)
- [StudentGradeDto](docs/Model/StudentGradeDto.md)
- [StudentVaxInfoDto](docs/Model/StudentVaxInfoDto.md)
- [TagCertOfGradInput](docs/Model/TagCertOfGradInput.md)
- [TagForm138Input](docs/Model/TagForm138Input.md)
- [TagFrom137aInput](docs/Model/TagFrom137aInput.md)
- [TagPsaInput](docs/Model/TagPsaInput.md)
- [TenantDbs](docs/Model/TenantDbs.md)
- [TransactionLogDto](docs/Model/TransactionLogDto.md)
- [TrialProgramDetailDto](docs/Model/TrialProgramDetailDto.md)
- [TrialProgramDto](docs/Model/TrialProgramDto.md)
- [UserForLoginDto](docs/Model/UserForLoginDto.md)
- [UserForRegisterDto](docs/Model/UserForRegisterDto.md)

## Authorization

Authentication schemes defined for the API:
### Bearer

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

rbsgaridan@usm.edu.ph

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `2.0`
    - Generator version: `7.9.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
