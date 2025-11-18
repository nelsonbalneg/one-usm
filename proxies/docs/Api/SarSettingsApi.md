# OpenAPI\Client\SarSettingsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet()**](SarSettingsApi.md#apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet) | **GET** /api/v2/sar/SarSettings/current-term-id/campus/{campusId} |  |


## `apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet()`

```php
apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet($campus_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarSettingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int

try {
    $apiInstance->apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet($campus_id);
} catch (Exception $e) {
    echo 'Exception when calling SarSettingsApi->apiV2SarSarSettingsCurrentTermIdCampusCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
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
