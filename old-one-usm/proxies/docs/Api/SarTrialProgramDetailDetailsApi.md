# OpenAPI\Client\SarTrialProgramDetailDetailsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarSarTrialProgramDetailDetailsIdDelete()**](SarTrialProgramDetailDetailsApi.md#apiV2SarSarTrialProgramDetailDetailsIdDelete) | **DELETE** /api/v2/sar/SarTrialProgramDetailDetails/{id} |  |
| [**apiV2SarSarTrialProgramDetailDetailsIdPut()**](SarTrialProgramDetailDetailsApi.md#apiV2SarSarTrialProgramDetailDetailsIdPut) | **PUT** /api/v2/sar/SarTrialProgramDetailDetails/{id} |  |
| [**apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut()**](SarTrialProgramDetailDetailsApi.md#apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut) | **PUT** /api/v2/sar/SarTrialProgramDetailDetails/{id}/update-schedule/{scheduleId}/campus/{campusId} |  |
| [**apiV2SarSarTrialProgramDetailDetailsPost()**](SarTrialProgramDetailDetailsApi.md#apiV2SarSarTrialProgramDetailDetailsPost) | **POST** /api/v2/sar/SarTrialProgramDetailDetails |  |
| [**getTrialProgramDetail()**](SarTrialProgramDetailDetailsApi.md#getTrialProgramDetail) | **GET** /api/v2/sar/SarTrialProgramDetailDetails/{id} |  |


## `apiV2SarSarTrialProgramDetailDetailsIdDelete()`

```php
apiV2SarSarTrialProgramDetailDetailsIdDelete($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramDetailDetailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->apiV2SarSarTrialProgramDetailDetailsIdDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramDetailDetailsApi->apiV2SarSarTrialProgramDetailDetailsIdDelete: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramDetailDetailsIdPut()`

```php
apiV2SarSarTrialProgramDetailDetailsIdPut($id, $trial_program_detail_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramDetailDetailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$trial_program_detail_dto = new \OpenAPI\Client\Model\TrialProgramDetailDto(); // \OpenAPI\Client\Model\TrialProgramDetailDto

try {
    $apiInstance->apiV2SarSarTrialProgramDetailDetailsIdPut($id, $trial_program_detail_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramDetailDetailsApi->apiV2SarSarTrialProgramDetailDetailsIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **trial_program_detail_dto** | [**\OpenAPI\Client\Model\TrialProgramDetailDto**](../Model/TrialProgramDetailDto.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut()`

```php
apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut($id, $schedule_id, $campus_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramDetailDetailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$schedule_id = 56; // int
$campus_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut($id, $schedule_id, $campus_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramDetailDetailsApi->apiV2SarSarTrialProgramDetailDetailsIdUpdateScheduleScheduleIdCampusCampusIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **schedule_id** | **int**|  | |
| **campus_id** | **int**|  | |
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

## `apiV2SarSarTrialProgramDetailDetailsPost()`

```php
apiV2SarSarTrialProgramDetailDetailsPost($trial_program_detail_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramDetailDetailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$trial_program_detail_dto = new \OpenAPI\Client\Model\TrialProgramDetailDto(); // \OpenAPI\Client\Model\TrialProgramDetailDto

try {
    $apiInstance->apiV2SarSarTrialProgramDetailDetailsPost($trial_program_detail_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramDetailDetailsApi->apiV2SarSarTrialProgramDetailDetailsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **trial_program_detail_dto** | [**\OpenAPI\Client\Model\TrialProgramDetailDto**](../Model/TrialProgramDetailDto.md)|  | [optional] |

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

## `getTrialProgramDetail()`

```php
getTrialProgramDetail($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramDetailDetailsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->getTrialProgramDetail($id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramDetailDetailsApi->getTrialProgramDetail: ', $e->getMessage(), PHP_EOL;
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
