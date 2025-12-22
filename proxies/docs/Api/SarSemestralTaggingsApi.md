# OpenAPI\Client\SarSemestralTaggingsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarSarSemestralTaggingsByStudentStudentNoGet()**](SarSemestralTaggingsApi.md#apiV2SarSarSemestralTaggingsByStudentStudentNoGet) | **GET** /api/v2/sar/SarSemestralTaggings/by-student/{studentNo} |  |
| [**apiV2SarSarSemestralTaggingsIdPut()**](SarSemestralTaggingsApi.md#apiV2SarSarSemestralTaggingsIdPut) | **PUT** /api/v2/sar/SarSemestralTaggings/{id} |  |
| [**apiV2SarSarSemestralTaggingsPost()**](SarSemestralTaggingsApi.md#apiV2SarSarSemestralTaggingsPost) | **POST** /api/v2/sar/SarSemestralTaggings |  |
| [**getSemestralTagging()**](SarSemestralTaggingsApi.md#getSemestralTagging) | **GET** /api/v2/sar/SarSemestralTaggings/{id} |  |


## `apiV2SarSarSemestralTaggingsByStudentStudentNoGet()`

```php
apiV2SarSarSemestralTaggingsByStudentStudentNoGet($student_no, $campus_id, $term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarSemestralTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$campus_id = 56; // int
$term_id = 56; // int

try {
    $apiInstance->apiV2SarSarSemestralTaggingsByStudentStudentNoGet($student_no, $campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling SarSemestralTaggingsApi->apiV2SarSarSemestralTaggingsByStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarSemestralTaggingsIdPut()`

```php
apiV2SarSarSemestralTaggingsIdPut($id, $semestral_tagging_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarSemestralTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$semestral_tagging_dto = new \OpenAPI\Client\Model\SemestralTaggingDto(); // \OpenAPI\Client\Model\SemestralTaggingDto

try {
    $apiInstance->apiV2SarSarSemestralTaggingsIdPut($id, $semestral_tagging_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarSemestralTaggingsApi->apiV2SarSarSemestralTaggingsIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **semestral_tagging_dto** | [**\OpenAPI\Client\Model\SemestralTaggingDto**](../Model/SemestralTaggingDto.md)|  | [optional] |

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

## `apiV2SarSarSemestralTaggingsPost()`

```php
apiV2SarSarSemestralTaggingsPost($semestral_tagging_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarSemestralTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$semestral_tagging_dto = new \OpenAPI\Client\Model\SemestralTaggingDto(); // \OpenAPI\Client\Model\SemestralTaggingDto

try {
    $apiInstance->apiV2SarSarSemestralTaggingsPost($semestral_tagging_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarSemestralTaggingsApi->apiV2SarSarSemestralTaggingsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **semestral_tagging_dto** | [**\OpenAPI\Client\Model\SemestralTaggingDto**](../Model/SemestralTaggingDto.md)|  | [optional] |

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

## `getSemestralTagging()`

```php
getSemestralTagging($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarSemestralTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->getSemestralTagging($id);
} catch (Exception $e) {
    echo 'Exception when calling SarSemestralTaggingsApi->getSemestralTagging: ', $e->getMessage(), PHP_EOL;
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
