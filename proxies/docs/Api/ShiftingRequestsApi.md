# OpenAPI\Client\ShiftingRequestsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarShiftingRequestsByStudentStudentNoGet()**](ShiftingRequestsApi.md#apiV2SarShiftingRequestsByStudentStudentNoGet) | **GET** /api/v2/sar/ShiftingRequests/by-student/{studentNo} |  |
| [**apiV2SarShiftingRequestsIdPut()**](ShiftingRequestsApi.md#apiV2SarShiftingRequestsIdPut) | **PUT** /api/v2/sar/ShiftingRequests/{id} |  |
| [**apiV2SarShiftingRequestsIdSubmitPut()**](ShiftingRequestsApi.md#apiV2SarShiftingRequestsIdSubmitPut) | **PUT** /api/v2/sar/ShiftingRequests/{id}/submit |  |
| [**apiV2SarShiftingRequestsPost()**](ShiftingRequestsApi.md#apiV2SarShiftingRequestsPost) | **POST** /api/v2/sar/ShiftingRequests |  |
| [**getShiftingRequest()**](ShiftingRequestsApi.md#getShiftingRequest) | **GET** /api/v2/sar/ShiftingRequests/{id} |  |


## `apiV2SarShiftingRequestsByStudentStudentNoGet()`

```php
apiV2SarShiftingRequestsByStudentStudentNoGet($student_no, $campus_id, $term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ShiftingRequestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$campus_id = 56; // int
$term_id = 56; // int

try {
    $apiInstance->apiV2SarShiftingRequestsByStudentStudentNoGet($student_no, $campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling ShiftingRequestsApi->apiV2SarShiftingRequestsByStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **campus_id** | **int**|  | [optional] |
| **term_id** | **int**|  | [optional] |

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

## `apiV2SarShiftingRequestsIdPut()`

```php
apiV2SarShiftingRequestsIdPut($id, $shifting_request_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ShiftingRequestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$shifting_request_dto = new \OpenAPI\Client\Model\ShiftingRequestDto(); // \OpenAPI\Client\Model\ShiftingRequestDto

try {
    $apiInstance->apiV2SarShiftingRequestsIdPut($id, $shifting_request_dto);
} catch (Exception $e) {
    echo 'Exception when calling ShiftingRequestsApi->apiV2SarShiftingRequestsIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **shifting_request_dto** | [**\OpenAPI\Client\Model\ShiftingRequestDto**](../Model/ShiftingRequestDto.md)|  | [optional] |

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

## `apiV2SarShiftingRequestsIdSubmitPut()`

```php
apiV2SarShiftingRequestsIdSubmitPut($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ShiftingRequestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->apiV2SarShiftingRequestsIdSubmitPut($id);
} catch (Exception $e) {
    echo 'Exception when calling ShiftingRequestsApi->apiV2SarShiftingRequestsIdSubmitPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

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

## `apiV2SarShiftingRequestsPost()`

```php
apiV2SarShiftingRequestsPost($shifting_request_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ShiftingRequestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$shifting_request_dto = new \OpenAPI\Client\Model\ShiftingRequestDto(); // \OpenAPI\Client\Model\ShiftingRequestDto

try {
    $apiInstance->apiV2SarShiftingRequestsPost($shifting_request_dto);
} catch (Exception $e) {
    echo 'Exception when calling ShiftingRequestsApi->apiV2SarShiftingRequestsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **shifting_request_dto** | [**\OpenAPI\Client\Model\ShiftingRequestDto**](../Model/ShiftingRequestDto.md)|  | [optional] |

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

## `getShiftingRequest()`

```php
getShiftingRequest($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ShiftingRequestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->getShiftingRequest($id);
} catch (Exception $e) {
    echo 'Exception when calling ShiftingRequestsApi->getShiftingRequest: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |

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
