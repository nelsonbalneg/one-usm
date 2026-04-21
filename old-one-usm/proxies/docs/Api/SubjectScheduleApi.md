# OpenAPI\Client\SubjectScheduleApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet()**](SubjectScheduleApi.md#apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet) | **GET** /api/v2/SubjectSchedule/campus/{campusId}/sched/{schedId}/term/{termId} |  |
| [**apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet()**](SubjectScheduleApi.md#apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet) | **GET** /api/v2/SubjectSchedule/curriculum/student/{studentId}/campus/{campusId}/term/{termId} |  |
| [**apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet()**](SubjectScheduleApi.md#apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet) | **GET** /api/v2/SubjectSchedule/sections/{sectionId}/campus/{campusId}/term/{termId} |  |
| [**apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet()**](SubjectScheduleApi.md#apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet) | **GET** /api/v2/SubjectSchedule/{subjectId}/campus/{campusId}/term/{termId} |  |


## `apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet()`

```php
apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet($sched_id, $campus_id, $term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SubjectScheduleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sched_id = 56; // int
$campus_id = 56; // int
$term_id = 'term_id_example'; // string

try {
    $apiInstance->apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet($sched_id, $campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling SubjectScheduleApi->apiV2SubjectScheduleCampusCampusIdSchedSchedIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **sched_id** | **int**|  | |
| **campus_id** | **int**|  | |
| **term_id** | **string**|  | |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet()`

```php
apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet($student_id, $campus_id, $term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SubjectScheduleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string
$campus_id = 56; // int
$term_id = 56; // int

try {
    $apiInstance->apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet($student_id, $campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling SubjectScheduleApi->apiV2SubjectScheduleCurriculumStudentStudentIdCampusCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
| **campus_id** | **int**|  | |
| **term_id** | **int**|  | |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet()`

```php
apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet($section_id, $campus_id, $term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SubjectScheduleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$section_id = 56; // int
$campus_id = 56; // int
$term_id = 56; // int

try {
    $apiInstance->apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet($section_id, $campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling SubjectScheduleApi->apiV2SubjectScheduleSectionsSectionIdCampusCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **section_id** | **int**|  | |
| **campus_id** | **int**|  | |
| **term_id** | **int**|  | |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet()`

```php
apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet($subject_id, $campus_id, $term_id, $current_term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SubjectScheduleApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$subject_id = 56; // int
$campus_id = 56; // int
$term_id = 'term_id_example'; // string
$current_term_id = 56; // int

try {
    $apiInstance->apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet($subject_id, $campus_id, $term_id, $current_term_id);
} catch (Exception $e) {
    echo 'Exception when calling SubjectScheduleApi->apiV2SubjectScheduleSubjectIdCampusCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **subject_id** | **int**|  | |
| **campus_id** | **int**|  | |
| **term_id** | **string**|  | |
| **current_term_id** | **int**|  | [optional] |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
