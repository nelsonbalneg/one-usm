# OpenAPI\Client\AlignEnrolmentApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2AlignEnrolmentResetApplicationPut()**](AlignEnrolmentApi.md#apiV2AlignEnrolmentResetApplicationPut) | **PUT** /api/v2/AlignEnrolment/reset-application |  |


## `apiV2AlignEnrolmentResetApplicationPut()`

```php
apiV2AlignEnrolmentResetApplicationPut($align_enrolment_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\AlignEnrolmentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$align_enrolment_dto = new \OpenAPI\Client\Model\AlignEnrolmentDto(); // \OpenAPI\Client\Model\AlignEnrolmentDto

try {
    $apiInstance->apiV2AlignEnrolmentResetApplicationPut($align_enrolment_dto);
} catch (Exception $e) {
    echo 'Exception when calling AlignEnrolmentApi->apiV2AlignEnrolmentResetApplicationPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **align_enrolment_dto** | [**\OpenAPI\Client\Model\AlignEnrolmentDto**](../Model/AlignEnrolmentDto.md)|  | [optional] |

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
