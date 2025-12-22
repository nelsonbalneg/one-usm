# OpenAPI\Client\SarPermanentTaggingsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarSarPermanentTaggingsByStudentStudentNoGet()**](SarPermanentTaggingsApi.md#apiV2SarSarPermanentTaggingsByStudentStudentNoGet) | **GET** /api/v2/sar/SarPermanentTaggings/by-student/{studentNo} |  |
| [**apiV2SarSarPermanentTaggingsIdPut()**](SarPermanentTaggingsApi.md#apiV2SarSarPermanentTaggingsIdPut) | **PUT** /api/v2/sar/SarPermanentTaggings/{id} |  |
| [**apiV2SarSarPermanentTaggingsPost()**](SarPermanentTaggingsApi.md#apiV2SarSarPermanentTaggingsPost) | **POST** /api/v2/sar/SarPermanentTaggings |  |
| [**getPermanentTagging()**](SarPermanentTaggingsApi.md#getPermanentTagging) | **GET** /api/v2/sar/SarPermanentTaggings/{id} |  |


## `apiV2SarSarPermanentTaggingsByStudentStudentNoGet()`

```php
apiV2SarSarPermanentTaggingsByStudentStudentNoGet($student_no, $campus_id, $term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarPermanentTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$campus_id = 56; // int
$term_id = 56; // int

try {
    $apiInstance->apiV2SarSarPermanentTaggingsByStudentStudentNoGet($student_no, $campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling SarPermanentTaggingsApi->apiV2SarSarPermanentTaggingsByStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarPermanentTaggingsIdPut()`

```php
apiV2SarSarPermanentTaggingsIdPut($id, $permanent_tagging_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarPermanentTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$permanent_tagging_dto = new \OpenAPI\Client\Model\PermanentTaggingDto(); // \OpenAPI\Client\Model\PermanentTaggingDto

try {
    $apiInstance->apiV2SarSarPermanentTaggingsIdPut($id, $permanent_tagging_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarPermanentTaggingsApi->apiV2SarSarPermanentTaggingsIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **permanent_tagging_dto** | [**\OpenAPI\Client\Model\PermanentTaggingDto**](../Model/PermanentTaggingDto.md)|  | [optional] |

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

## `apiV2SarSarPermanentTaggingsPost()`

```php
apiV2SarSarPermanentTaggingsPost($permanent_tagging_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarPermanentTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$permanent_tagging_dto = new \OpenAPI\Client\Model\PermanentTaggingDto(); // \OpenAPI\Client\Model\PermanentTaggingDto

try {
    $apiInstance->apiV2SarSarPermanentTaggingsPost($permanent_tagging_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarPermanentTaggingsApi->apiV2SarSarPermanentTaggingsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **permanent_tagging_dto** | [**\OpenAPI\Client\Model\PermanentTaggingDto**](../Model/PermanentTaggingDto.md)|  | [optional] |

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

## `getPermanentTagging()`

```php
getPermanentTagging($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarPermanentTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->getPermanentTagging($id);
} catch (Exception $e) {
    echo 'Exception when calling SarPermanentTaggingsApi->getPermanentTagging: ', $e->getMessage(), PHP_EOL;
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
