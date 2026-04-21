# OpenAPI\Client\ClassSchedulesApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet()**](ClassSchedulesApi.md#apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet) | **GET** /api/v2/ClassSchedules/get-all-faculty-for-eval/reg/{regId} |  |
| [**apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet()**](ClassSchedulesApi.md#apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet) | **GET** /api/v2/ClassSchedules/get-schedule-by-subject/term/{termId}/subject/{subjectId} |  |
| [**apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet()**](ClassSchedulesApi.md#apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet) | **GET** /api/v2/ClassSchedules/get-schedules-by-section/{termId}/{sectionId} |  |


## `apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet()`

```php
apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet($reg_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ClassSchedulesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reg_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet($reg_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ClassSchedulesApi->apiV2ClassSchedulesGetAllFacultyForEvalRegRegIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **reg_id** | **int**|  | |
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

## `apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet()`

```php
apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet($term_id, $subject_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ClassSchedulesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$subject_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet($term_id, $subject_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ClassSchedulesApi->apiV2ClassSchedulesGetScheduleBySubjectTermTermIdSubjectSubjectIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **subject_id** | **int**|  | |
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

## `apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet()`

```php
apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet($term_id, $section_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ClassSchedulesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$section_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet($term_id, $section_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ClassSchedulesApi->apiV2ClassSchedulesGetSchedulesBySectionTermIdSectionIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **section_id** | **int**|  | |
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
