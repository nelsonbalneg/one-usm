# OpenAPI\Client\StudentVaxInfosApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet()**](StudentVaxInfosApi.md#apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet) | **GET** /api/v2/StudentVaxInfos/campus/{campusId}/student/{studentNo} |  |
| [**apiV2StudentVaxInfosIdCampusCampusIdPut()**](StudentVaxInfosApi.md#apiV2StudentVaxInfosIdCampusCampusIdPut) | **PUT** /api/v2/StudentVaxInfos/{id}/campus/{campusId} |  |
| [**apiV2StudentVaxInfosOncampusCampusIdPost()**](StudentVaxInfosApi.md#apiV2StudentVaxInfosOncampusCampusIdPost) | **POST** /api/v2/StudentVaxInfos/oncampus/{campusId} |  |
| [**apiV2StudentVaxInfosStudentNoCampusCampusIdDelete()**](StudentVaxInfosApi.md#apiV2StudentVaxInfosStudentNoCampusCampusIdDelete) | **DELETE** /api/v2/StudentVaxInfos/{studentNo}/campus/{campusId} |  |
| [**apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet()**](StudentVaxInfosApi.md#apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet) | **GET** /api/v2/StudentVaxInfos/verifystudent/{studentNo}/campus/{campusId} |  |
| [**getVaxInfo()**](StudentVaxInfosApi.md#getVaxInfo) | **GET** /api/v2/StudentVaxInfos/{id}/campus/{campusId} |  |


## `apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet()`

```php
apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet($campus_id, $student_no)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentVaxInfosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$student_no = 'student_no_example'; // string

try {
    $apiInstance->apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet($campus_id, $student_no);
} catch (Exception $e) {
    echo 'Exception when calling StudentVaxInfosApi->apiV2StudentVaxInfosCampusCampusIdStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | |
| **student_no** | **string**|  | |

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

## `apiV2StudentVaxInfosIdCampusCampusIdPut()`

```php
apiV2StudentVaxInfosIdCampusCampusIdPut($id, $campus_id, $student_vax_info_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentVaxInfosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$campus_id = 56; // int
$student_vax_info_dto = new \OpenAPI\Client\Model\StudentVaxInfoDto(); // \OpenAPI\Client\Model\StudentVaxInfoDto

try {
    $apiInstance->apiV2StudentVaxInfosIdCampusCampusIdPut($id, $campus_id, $student_vax_info_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentVaxInfosApi->apiV2StudentVaxInfosIdCampusCampusIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **campus_id** | **int**|  | |
| **student_vax_info_dto** | [**\OpenAPI\Client\Model\StudentVaxInfoDto**](../Model/StudentVaxInfoDto.md)|  | [optional] |

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

## `apiV2StudentVaxInfosOncampusCampusIdPost()`

```php
apiV2StudentVaxInfosOncampusCampusIdPost($campus_id, $student_vax_info_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentVaxInfosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$student_vax_info_dto = new \OpenAPI\Client\Model\StudentVaxInfoDto(); // \OpenAPI\Client\Model\StudentVaxInfoDto

try {
    $apiInstance->apiV2StudentVaxInfosOncampusCampusIdPost($campus_id, $student_vax_info_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentVaxInfosApi->apiV2StudentVaxInfosOncampusCampusIdPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | |
| **student_vax_info_dto** | [**\OpenAPI\Client\Model\StudentVaxInfoDto**](../Model/StudentVaxInfoDto.md)|  | [optional] |

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

## `apiV2StudentVaxInfosStudentNoCampusCampusIdDelete()`

```php
apiV2StudentVaxInfosStudentNoCampusCampusIdDelete($student_no, $campus_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentVaxInfosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$campus_id = 56; // int

try {
    $apiInstance->apiV2StudentVaxInfosStudentNoCampusCampusIdDelete($student_no, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentVaxInfosApi->apiV2StudentVaxInfosStudentNoCampusCampusIdDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
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

## `apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet()`

```php
apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet($student_no, $campus_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentVaxInfosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$campus_id = 56; // int

try {
    $apiInstance->apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet($student_no, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentVaxInfosApi->apiV2StudentVaxInfosVerifystudentStudentNoCampusCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
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

## `getVaxInfo()`

```php
getVaxInfo($id, $campus_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentVaxInfosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$campus_id = 56; // int

try {
    $apiInstance->getVaxInfo($id, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentVaxInfosApi->getVaxInfo: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
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
