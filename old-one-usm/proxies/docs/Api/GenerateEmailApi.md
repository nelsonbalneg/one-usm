# OpenAPI\Client\GenerateEmailApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2GenerateEmailGet()**](GenerateEmailApi.md#apiV2GenerateEmailGet) | **GET** /api/v2/GenerateEmail |  |
| [**apiV2GenerateEmailRegenEmailPost()**](GenerateEmailApi.md#apiV2GenerateEmailRegenEmailPost) | **POST** /api/v2/GenerateEmail/regen-email |  |
| [**apiV2GenerateEmailRegenEmailStudentNoRepsPost()**](GenerateEmailApi.md#apiV2GenerateEmailRegenEmailStudentNoRepsPost) | **POST** /api/v2/GenerateEmail/regen-email/{studentNo}/{reps} |  |


## `apiV2GenerateEmailGet()`

```php
apiV2GenerateEmailGet($lastname, $firstname, $middle)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GenerateEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$lastname = 'lastname_example'; // string
$firstname = 'firstname_example'; // string
$middle = 'middle_example'; // string

try {
    $apiInstance->apiV2GenerateEmailGet($lastname, $firstname, $middle);
} catch (Exception $e) {
    echo 'Exception when calling GenerateEmailApi->apiV2GenerateEmailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **lastname** | **string**|  | [optional] |
| **firstname** | **string**|  | [optional] |
| **middle** | **string**|  | [optional] |

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

## `apiV2GenerateEmailRegenEmailPost()`

```php
apiV2GenerateEmailRegenEmailPost($tenant_id, $idprefix)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GenerateEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$idprefix = '24-'; // string

try {
    $apiInstance->apiV2GenerateEmailRegenEmailPost($tenant_id, $idprefix);
} catch (Exception $e) {
    echo 'Exception when calling GenerateEmailApi->apiV2GenerateEmailRegenEmailPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **idprefix** | **string**|  | [optional] [default to &#39;24-&#39;] |

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

## `apiV2GenerateEmailRegenEmailStudentNoRepsPost()`

```php
apiV2GenerateEmailRegenEmailStudentNoRepsPost($student_no, $reps, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GenerateEmailApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$reps = 1; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GenerateEmailRegenEmailStudentNoRepsPost($student_no, $reps, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GenerateEmailApi->apiV2GenerateEmailRegenEmailStudentNoRepsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **reps** | **int**|  | [default to 1] |
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
