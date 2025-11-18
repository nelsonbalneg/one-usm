# OpenAPI\Client\ProgramMajorsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2ProgramMajorsFilterGet()**](ProgramMajorsApi.md#apiV2ProgramMajorsFilterGet) | **GET** /api/v2/ProgramMajors/filter |  |
| [**apiV2ProgramMajorsIdGet()**](ProgramMajorsApi.md#apiV2ProgramMajorsIdGet) | **GET** /api/v2/ProgramMajors/{id} |  |
| [**apiV2ProgramMajorsProgramProgramIdGet()**](ProgramMajorsApi.md#apiV2ProgramMajorsProgramProgramIdGet) | **GET** /api/v2/ProgramMajors/program/{programId} |  |


## `apiV2ProgramMajorsFilterGet()`

```php
apiV2ProgramMajorsFilterGet($college_id, $program_id, $prog_id, $policy_id, $campus_id, $prog_class, $student_no, $order_by, $descending, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramMajorsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$college_id = 56; // int
$program_id = 56; // int
$prog_id = 56; // int
$policy_id = 56; // int
$campus_id = 56; // int
$prog_class = 56; // int
$student_no = 'student_no_example'; // string
$order_by = 'order_by_example'; // string
$descending = True; // bool
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ProgramMajorsFilterGet($college_id, $program_id, $prog_id, $policy_id, $campus_id, $prog_class, $student_no, $order_by, $descending, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramMajorsApi->apiV2ProgramMajorsFilterGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **college_id** | **int**|  | [optional] |
| **program_id** | **int**|  | [optional] |
| **prog_id** | **int**|  | [optional] |
| **policy_id** | **int**|  | [optional] |
| **campus_id** | **int**|  | [optional] |
| **prog_class** | **int**|  | [optional] |
| **student_no** | **string**|  | [optional] |
| **order_by** | **string**|  | [optional] |
| **descending** | **bool**|  | [optional] |
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

## `apiV2ProgramMajorsIdGet()`

```php
apiV2ProgramMajorsIdGet($id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramMajorsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ProgramMajorsIdGet($id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramMajorsApi->apiV2ProgramMajorsIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
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

## `apiV2ProgramMajorsProgramProgramIdGet()`

```php
apiV2ProgramMajorsProgramProgramIdGet($program_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramMajorsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$program_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ProgramMajorsProgramProgramIdGet($program_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramMajorsApi->apiV2ProgramMajorsProgramProgramIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **program_id** | **int**|  | |
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
