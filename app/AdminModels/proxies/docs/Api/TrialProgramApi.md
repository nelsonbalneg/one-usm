# OpenAPI\Client\TrialProgramApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2TrialProgramCurriculumStudentStudentIdGet()**](TrialProgramApi.md#apiV2TrialProgramCurriculumStudentStudentIdGet) | **GET** /api/v2/TrialProgram/curriculum/student/{studentId} | Curriculum view for adviser |
| [**apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet()**](TrialProgramApi.md#apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet) | **GET** /api/v2/TrialProgram/curriculum/student/{studentId}/term/{termId} | Curriculum view for student |
| [**apiV2TrialProgramEvaluationStudentStudentIdGet()**](TrialProgramApi.md#apiV2TrialProgramEvaluationStudentStudentIdGet) | **GET** /api/v2/TrialProgram/evaluation/student/{studentId} | Evaluation view for adviser |
| [**apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet()**](TrialProgramApi.md#apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet) | **GET** /api/v2/TrialProgram/getstudentsbysection/{sectionId}/{termId} |  |
| [**apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet()**](TrialProgramApi.md#apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet) | **GET** /api/v2/TrialProgram/getstudentstreebycampus/{campusId}/{previousTermId} |  |
| [**apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet()**](TrialProgramApi.md#apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet) | **GET** /api/v2/TrialProgram/student/{studentId}/term/{currentTermId} |  |


## `apiV2TrialProgramCurriculumStudentStudentIdGet()`

```php
apiV2TrialProgramCurriculumStudentStudentIdGet($student_id, $tenant_id)
```

Curriculum view for adviser

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\TrialProgramApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2TrialProgramCurriculumStudentStudentIdGet($student_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling TrialProgramApi->apiV2TrialProgramCurriculumStudentStudentIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
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

## `apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet()`

```php
apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet($student_id, $term_id, $tenant_id)
```

Curriculum view for student

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\TrialProgramApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string | 
$term_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet($student_id, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling TrialProgramApi->apiV2TrialProgramCurriculumStudentStudentIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
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

## `apiV2TrialProgramEvaluationStudentStudentIdGet()`

```php
apiV2TrialProgramEvaluationStudentStudentIdGet($student_id, $tenant_id)
```

Evaluation view for adviser

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\TrialProgramApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2TrialProgramEvaluationStudentStudentIdGet($student_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling TrialProgramApi->apiV2TrialProgramEvaluationStudentStudentIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
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

## `apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet()`

```php
apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet($section_id, $term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\TrialProgramApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$section_id = 56; // int
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet($section_id, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling TrialProgramApi->apiV2TrialProgramGetstudentsbysectionSectionIdTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **section_id** | **int**|  | |
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

## `apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet()`

```php
apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet($campus_id, $previous_term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\TrialProgramApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$previous_term_id = 56; // int

try {
    $apiInstance->apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet($campus_id, $previous_term_id);
} catch (Exception $e) {
    echo 'Exception when calling TrialProgramApi->apiV2TrialProgramGetstudentstreebycampusCampusIdPreviousTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | |
| **previous_term_id** | **int**|  | |

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

## `apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet()`

```php
apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet($student_id, $current_term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\TrialProgramApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string
$current_term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet($student_id, $current_term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling TrialProgramApi->apiV2TrialProgramStudentStudentIdTermCurrentTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
| **current_term_id** | **int**|  | |
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
