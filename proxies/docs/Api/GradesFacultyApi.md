# OpenAPI\Client\GradesFacultyApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2GradesFacultyFacultyloadEmpNoGet()**](GradesFacultyApi.md#apiV2GradesFacultyFacultyloadEmpNoGet) | **GET** /api/v2/GradesFaculty/facultyload/{EmpNo} |  |
| [**apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet()**](GradesFacultyApi.md#apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet) | **GET** /api/v2/GradesFaculty/gradingsheetbyschedule/{scheduleId}/term/{termId} |  |
| [**apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet()**](GradesFacultyApi.md#apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet) | **GET** /api/v2/GradesFaculty/gradingsheetposteddate/{scheduleId}/term/{termId} |  |
| [**apiV2GradesFacultyGradingsystemProgClassIDGet()**](GradesFacultyApi.md#apiV2GradesFacultyGradingsystemProgClassIDGet) | **GET** /api/v2/GradesFaculty/gradingsystem/{ProgClassID} |  |
| [**apiV2GradesFacultyGradingsystemsettingsProgClassIDGet()**](GradesFacultyApi.md#apiV2GradesFacultyGradingsystemsettingsProgClassIDGet) | **GET** /api/v2/GradesFaculty/gradingsystemsettings/{ProgClassID} |  |
| [**apiV2GradesFacultyPost()**](GradesFacultyApi.md#apiV2GradesFacultyPost) | **POST** /api/v2/GradesFaculty |  |
| [**apiV2GradesFacultyPostgradingsheetPut()**](GradesFacultyApi.md#apiV2GradesFacultyPostgradingsheetPut) | **PUT** /api/v2/GradesFaculty/postgradingsheet |  |
| [**apiV2GradesFacultyUpdateStudentFinalGradePut()**](GradesFacultyApi.md#apiV2GradesFacultyUpdateStudentFinalGradePut) | **PUT** /api/v2/GradesFaculty/update-student-final-grade |  |
| [**apiV2GradesFacultyUpdateStudentMidtermPut()**](GradesFacultyApi.md#apiV2GradesFacultyUpdateStudentMidtermPut) | **PUT** /api/v2/GradesFaculty/update-student-midterm |  |
| [**apiV2GradesFacultyUpdategradeofstudentPut()**](GradesFacultyApi.md#apiV2GradesFacultyUpdategradeofstudentPut) | **PUT** /api/v2/GradesFaculty/updategradeofstudent |  |


## `apiV2GradesFacultyFacultyloadEmpNoGet()`

```php
apiV2GradesFacultyFacultyloadEmpNoGet($emp_no, $term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$emp_no = 'emp_no_example'; // string
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GradesFacultyFacultyloadEmpNoGet($emp_no, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyFacultyloadEmpNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **emp_no** | **string**|  | |
| **term_id** | **int**|  | [optional] |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

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

## `apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet()`

```php
apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet($schedule_id, $term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$schedule_id = 56; // int
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet($schedule_id, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyGradingsheetbyscheduleScheduleIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **schedule_id** | **int**|  | |
| **term_id** | **int**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

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

## `apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet()`

```php
apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet($schedule_id, $term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$schedule_id = 56; // int
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet($schedule_id, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyGradingsheetposteddateScheduleIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **schedule_id** | **int**|  | |
| **term_id** | **int**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

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

## `apiV2GradesFacultyGradingsystemProgClassIDGet()`

```php
apiV2GradesFacultyGradingsystemProgClassIDGet($prog_class_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$prog_class_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GradesFacultyGradingsystemProgClassIDGet($prog_class_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyGradingsystemProgClassIDGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **prog_class_id** | **int**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

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

## `apiV2GradesFacultyGradingsystemsettingsProgClassIDGet()`

```php
apiV2GradesFacultyGradingsystemsettingsProgClassIDGet($prog_class_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$prog_class_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GradesFacultyGradingsystemsettingsProgClassIDGet($prog_class_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyGradingsystemsettingsProgClassIDGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **prog_class_id** | **int**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

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

## `apiV2GradesFacultyPost()`

```php
apiV2GradesFacultyPost($tenant_id, $grades_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$grades_dto = array(new \OpenAPI\Client\Model\GradesDto()); // \OpenAPI\Client\Model\GradesDto[]

try {
    $apiInstance->apiV2GradesFacultyPost($tenant_id, $grades_dto);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **grades_dto** | [**\OpenAPI\Client\Model\GradesDto[]**](../Model/GradesDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json-patch+json; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`, `application/*+json; x-api-version=2.0`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2GradesFacultyPostgradingsheetPut()`

```php
apiV2GradesFacultyPostgradingsheetPut($schedule_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$schedule_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GradesFacultyPostgradingsheetPut($schedule_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyPostgradingsheetPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **schedule_id** | **int**|  | [optional] |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

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

## `apiV2GradesFacultyUpdateStudentFinalGradePut()`

```php
apiV2GradesFacultyUpdateStudentFinalGradePut($tenant_id, $student_grade_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_grade_dto = new \OpenAPI\Client\Model\StudentGradeDto(); // \OpenAPI\Client\Model\StudentGradeDto

try {
    $apiInstance->apiV2GradesFacultyUpdateStudentFinalGradePut($tenant_id, $student_grade_dto);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyUpdateStudentFinalGradePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_grade_dto** | [**\OpenAPI\Client\Model\StudentGradeDto**](../Model/StudentGradeDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json-patch+json; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`, `application/*+json; x-api-version=2.0`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2GradesFacultyUpdateStudentMidtermPut()`

```php
apiV2GradesFacultyUpdateStudentMidtermPut($tenant_id, $student_grade_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_grade_dto = new \OpenAPI\Client\Model\StudentGradeDto(); // \OpenAPI\Client\Model\StudentGradeDto

try {
    $apiInstance->apiV2GradesFacultyUpdateStudentMidtermPut($tenant_id, $student_grade_dto);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyUpdateStudentMidtermPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_grade_dto** | [**\OpenAPI\Client\Model\StudentGradeDto**](../Model/StudentGradeDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json-patch+json; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`, `application/*+json; x-api-version=2.0`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2GradesFacultyUpdategradeofstudentPut()`

```php
apiV2GradesFacultyUpdategradeofstudentPut($tenant_id, $student_grade_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GradesFacultyApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_grade_dto = new \OpenAPI\Client\Model\StudentGradeDto(); // \OpenAPI\Client\Model\StudentGradeDto

try {
    $apiInstance->apiV2GradesFacultyUpdategradeofstudentPut($tenant_id, $student_grade_dto);
} catch (Exception $e) {
    echo 'Exception when calling GradesFacultyApi->apiV2GradesFacultyUpdategradeofstudentPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_grade_dto** | [**\OpenAPI\Client\Model\StudentGradeDto**](../Model/StudentGradeDto.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json-patch+json; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`, `application/*+json; x-api-version=2.0`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
