# OpenAPI\Client\ReportsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2ReportsEnrollmentstatusTermTermIdGet()**](ReportsApi.md#apiV2ReportsEnrollmentstatusTermTermIdGet) | **GET** /api/v2/Reports/enrollmentstatus/term/{termId} |  |
| [**apiV2ReportsTotalernrolledTermTermIdGet()**](ReportsApi.md#apiV2ReportsTotalernrolledTermTermIdGet) | **GET** /api/v2/Reports/totalernrolled/term/{termId} |  |


## `apiV2ReportsEnrollmentstatusTermTermIdGet()`

```php
apiV2ReportsEnrollmentstatusTermTermIdGet($term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ReportsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ReportsEnrollmentstatusTermTermIdGet($term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ReportsApi->apiV2ReportsEnrollmentstatusTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
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

## `apiV2ReportsTotalernrolledTermTermIdGet()`

```php
apiV2ReportsTotalernrolledTermTermIdGet($term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ReportsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2ReportsTotalernrolledTermTermIdGet($term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ReportsApi->apiV2ReportsTotalernrolledTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
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
