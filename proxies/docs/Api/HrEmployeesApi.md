# OpenAPI\Client\HrEmployeesApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2HrEmployeesUserIdPut()**](HrEmployeesApi.md#apiV2HrEmployeesUserIdPut) | **PUT** /api/v2/HrEmployees/{userId} |  |


## `apiV2HrEmployeesUserIdPut()`

```php
apiV2HrEmployeesUserIdPut($user_id, $tenant_id, $put_hr_employee_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\HrEmployeesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_id = 'user_id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$put_hr_employee_dto = new \OpenAPI\Client\Model\PutHrEmployeeDto(); // \OpenAPI\Client\Model\PutHrEmployeeDto

try {
    $apiInstance->apiV2HrEmployeesUserIdPut($user_id, $tenant_id, $put_hr_employee_dto);
} catch (Exception $e) {
    echo 'Exception when calling HrEmployeesApi->apiV2HrEmployeesUserIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_id** | **string**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **put_hr_employee_dto** | [**\OpenAPI\Client\Model\PutHrEmployeeDto**](../Model/PutHrEmployeeDto.md)|  | [optional] |

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
