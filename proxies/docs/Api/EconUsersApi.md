# OpenAPI\Client\EconUsersApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet()**](EconUsersApi.md#apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet) | **GET** /api/v2/EconUsers/{employeeId}/programPolicies/campus/{campusId} | Get all programs under the employee |
| [**apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet()**](EconUsersApi.md#apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet) | **GET** /api/v2/EconUsers/{employeeId}/programPolicies/tenant/{tenantId} |  |
| [**apiV2EconUsersLoginPost()**](EconUsersApi.md#apiV2EconUsersLoginPost) | **POST** /api/v2/EconUsers/login |  |


## `apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet()`

```php
apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet($employee_id, $campus_id)
```

Get all programs under the employee

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\EconUsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$employee_id = 'employee_id_example'; // string | 
$campus_id = 56; // int | 

try {
    $apiInstance->apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet($employee_id, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling EconUsersApi->apiV2EconUsersEmployeeIdProgramPoliciesCampusCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **employee_id** | **string**|  | |
| **campus_id** | **int**|  | |

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

## `apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet()`

```php
apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet($employee_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\EconUsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$employee_id = 'employee_id_example'; // string
$tenant_id = 56; // int

try {
    $apiInstance->apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet($employee_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling EconUsersApi->apiV2EconUsersEmployeeIdProgramPoliciesTenantTenantIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **employee_id** | **string**|  | |
| **tenant_id** | **int**|  | |

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

## `apiV2EconUsersLoginPost()`

```php
apiV2EconUsersLoginPost($user_for_login_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\EconUsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$user_for_login_dto = new \OpenAPI\Client\Model\UserForLoginDto(); // \OpenAPI\Client\Model\UserForLoginDto

try {
    $apiInstance->apiV2EconUsersLoginPost($user_for_login_dto);
} catch (Exception $e) {
    echo 'Exception when calling EconUsersApi->apiV2EconUsersLoginPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_for_login_dto** | [**\OpenAPI\Client\Model\UserForLoginDto**](../Model/UserForLoginDto.md)|  | [optional] |

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
