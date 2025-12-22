# OpenAPI\Client\CurriculumsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2CurriculumsFilterByPolicyIdPolicyIdGet()**](CurriculumsApi.md#apiV2CurriculumsFilterByPolicyIdPolicyIdGet) | **GET** /api/v2/Curriculums/filter/by-policyId/{policyId} | Filter curriculums by policyId |
| [**apiV2CurriculumsFilterProgramProgramIdGet()**](CurriculumsApi.md#apiV2CurriculumsFilterProgramProgramIdGet) | **GET** /api/v2/Curriculums/filter/program/{programId} | Filter by campus and program |
| [**apiV2CurriculumsListGet()**](CurriculumsApi.md#apiV2CurriculumsListGet) | **GET** /api/v2/Curriculums/list |  |


## `apiV2CurriculumsFilterByPolicyIdPolicyIdGet()`

```php
apiV2CurriculumsFilterByPolicyIdPolicyIdGet($policy_id, $tenant_id)
```

Filter curriculums by policyId

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CurriculumsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2CurriculumsFilterByPolicyIdPolicyIdGet($policy_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling CurriculumsApi->apiV2CurriculumsFilterByPolicyIdPolicyIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **policy_id** | **int**|  | |
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

## `apiV2CurriculumsFilterProgramProgramIdGet()`

```php
apiV2CurriculumsFilterProgramProgramIdGet($program_id, $tenant_id)
```

Filter by campus and program

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CurriculumsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$program_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2CurriculumsFilterProgramProgramIdGet($program_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling CurriculumsApi->apiV2CurriculumsFilterProgramProgramIdGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2CurriculumsListGet()`

```php
apiV2CurriculumsListGet($campus_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CurriculumsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2CurriculumsListGet($campus_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling CurriculumsApi->apiV2CurriculumsListGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | [optional] |
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
