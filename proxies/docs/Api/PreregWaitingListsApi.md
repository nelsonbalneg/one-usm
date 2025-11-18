# OpenAPI\Client\PreregWaitingListsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2PreregWaitingListsGetListGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsGetListGet) | **GET** /api/v2/PreregWaitingLists/get-list |  |
| [**apiV2PreregWaitingListsNameAppNumberAppNumberGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsNameAppNumberAppNumberGet) | **GET** /api/v2/PreregWaitingLists/name/app-number/{appNumber} |  |
| [**apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet) | **GET** /api/v2/PreregWaitingLists/names/policyId/{policyId} |  |
| [**apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet) | **GET** /api/v2/PreregWaitingLists/names/real-campus/{realCampusId}/term/{termId} | Names of applicants in waitlist |
| [**apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet) | **GET** /api/v2/PreregWaitingLists/names/termId/{termId}/realCampusId/{realCampusId}/college/{collegeId} |  |
| [**apiV2PreregWaitingListsPost()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsPost) | **POST** /api/v2/PreregWaitingLists |  |
| [**apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet) | **GET** /api/v2/PreregWaitingLists/pre-regnames/real-campus/{realCampusId}/term/{termId} | Names of applicants in pre-reg |
| [**apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet) | **GET** /api/v2/PreregWaitingLists/prereg-totals/real-campus/{realCampusId}/term/{termId} | Pre-registration Totals |
| [**apiV2PreregWaitingListsRealCampusesGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsRealCampusesGet) | **GET** /api/v2/PreregWaitingLists/real-campuses |  |
| [**apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet) | **GET** /api/v2/PreregWaitingLists/totals/campus/{campusId}/term/{termId} | Reservation Totals |
| [**apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet) | **GET** /api/v2/PreregWaitingLists/totals/policyId/{policyId} | Reservation total per policy |
| [**apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet()**](PreregWaitingListsApi.md#apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet) | **GET** /api/v2/PreregWaitingLists/totals/real-campus/{realCampusId}/term/{termId} | Reservation Totals (Real Campus) |


## `apiV2PreregWaitingListsGetListGet()`

```php
apiV2PreregWaitingListsGetListGet($keyword, $page, $page_size)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$keyword = ''; // string
$page = 1; // int
$page_size = 10; // int

try {
    $apiInstance->apiV2PreregWaitingListsGetListGet($keyword, $page, $page_size);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsGetListGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **keyword** | **string**|  | [optional] [default to &#39;&#39;] |
| **page** | **int**|  | [optional] [default to 1] |
| **page_size** | **int**|  | [optional] [default to 10] |

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

## `apiV2PreregWaitingListsNameAppNumberAppNumberGet()`

```php
apiV2PreregWaitingListsNameAppNumberAppNumberGet($app_number)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_number = 'app_number_example'; // string

try {
    $apiInstance->apiV2PreregWaitingListsNameAppNumberAppNumberGet($app_number);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsNameAppNumberAppNumberGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **app_number** | **string**|  | |

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

## `apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet()`

```php
apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet($policy_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int

try {
    $apiInstance->apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet($policy_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsNamesPolicyIdPolicyIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **policy_id** | **int**|  | |

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

## `apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet()`

```php
apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id)
```

Names of applicants in waitlist

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$real_campus_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsNamesRealCampusRealCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **real_campus_id** | **int**|  | |
| **term_id** | **int**|  | |

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

## `apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet()`

```php
apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet($term_id, $real_campus_id, $college_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$real_campus_id = 56; // int
$college_id = 56; // int

try {
    $apiInstance->apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet($term_id, $real_campus_id, $college_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsNamesTermIdTermIdRealCampusIdRealCampusIdCollegeCollegeIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **real_campus_id** | **int**|  | |
| **college_id** | **int**|  | |

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

## `apiV2PreregWaitingListsPost()`

```php
apiV2PreregWaitingListsPost($reservation_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reservation_dto = new \OpenAPI\Client\Model\ReservationDto(); // \OpenAPI\Client\Model\ReservationDto

try {
    $apiInstance->apiV2PreregWaitingListsPost($reservation_dto);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **reservation_dto** | [**\OpenAPI\Client\Model\ReservationDto**](../Model/ReservationDto.md)|  | [optional] |

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

## `apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet()`

```php
apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id)
```

Names of applicants in pre-reg

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$real_campus_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsPreRegnamesRealCampusRealCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **real_campus_id** | **int**|  | |
| **term_id** | **int**|  | |

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

## `apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet()`

```php
apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id)
```

Pre-registration Totals

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$real_campus_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsPreregTotalsRealCampusRealCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **real_campus_id** | **int**|  | |
| **term_id** | **int**|  | |

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

## `apiV2PreregWaitingListsRealCampusesGet()`

```php
apiV2PreregWaitingListsRealCampusesGet()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2PreregWaitingListsRealCampusesGet();
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsRealCampusesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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

## `apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet()`

```php
apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet($campus_id, $term_id)
```

Reservation Totals

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet($campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsTotalsCampusCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | |
| **term_id** | **int**|  | |

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

## `apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet()`

```php
apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet($policy_id)
```

Reservation total per policy

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 

try {
    $apiInstance->apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet($policy_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsTotalsPolicyIdPolicyIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **policy_id** | **int**|  | |

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

## `apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet()`

```php
apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id)
```

Reservation Totals (Real Campus)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PreregWaitingListsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$real_campus_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling PreregWaitingListsApi->apiV2PreregWaitingListsTotalsRealCampusRealCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **real_campus_id** | **int**|  | |
| **term_id** | **int**|  | |

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
