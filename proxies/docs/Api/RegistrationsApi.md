# OpenAPI\Client\RegistrationsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2RegistrationsBalanceStudentNoGet()**](RegistrationsApi.md#apiV2RegistrationsBalanceStudentNoGet) | **GET** /api/v2/Registrations/balance/{studentNo} | Get total student balance |
| [**apiV2RegistrationsBystudentStudentNoTermTermIdGet()**](RegistrationsApi.md#apiV2RegistrationsBystudentStudentNoTermTermIdGet) | **GET** /api/v2/Registrations/bystudent/{studentNo}/term/{termId} | Get student registration record by term |
| [**apiV2RegistrationsCorrectemailsfromgoogletostudentPut()**](RegistrationsApi.md#apiV2RegistrationsCorrectemailsfromgoogletostudentPut) | **PUT** /api/v2/Registrations/correctemailsfromgoogletostudent |  |
| [**apiV2RegistrationsCorrectemailsofstudentsTermIdPut()**](RegistrationsApi.md#apiV2RegistrationsCorrectemailsofstudentsTermIdPut) | **PUT** /api/v2/Registrations/correctemailsofstudents/{termId} |  |
| [**apiV2RegistrationsGetAllRegistrationsStudentNoGet()**](RegistrationsApi.md#apiV2RegistrationsGetAllRegistrationsStudentNoGet) | **GET** /api/v2/Registrations/get-all-registrations/{studentNo} |  |
| [**apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet()**](RegistrationsApi.md#apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet) | **GET** /api/v2/Registrations/{regId}/get-student/{studentNo}/term/{termId} | Verify student registration |
| [**apiV2RegistrationsSchedulesStudentNoTermIdGet()**](RegistrationsApi.md#apiV2RegistrationsSchedulesStudentNoTermIdGet) | **GET** /api/v2/Registrations/schedules/{studentNo}/{termId} | get schedules by term and campus |
| [**apiV2RegistrationsStudentAccountabilitiesStudentNoGet()**](RegistrationsApi.md#apiV2RegistrationsStudentAccountabilitiesStudentNoGet) | **GET** /api/v2/Registrations/student-accountabilities/{studentNo} | Get all outstanding Accountabilities |
| [**apiV2RegistrationsTermTermIdStudentStudentNoGet()**](RegistrationsApi.md#apiV2RegistrationsTermTermIdStudentStudentNoGet) | **GET** /api/v2/Registrations/term/{termId}/student/{studentNo} | Get student section |
| [**apiV2RegistrationsTotalernrolledTermTermIdGet()**](RegistrationsApi.md#apiV2RegistrationsTotalernrolledTermTermIdGet) | **GET** /api/v2/Registrations/totalernrolled/term/{termId} | Counts all enrolled students based on campus and term |
| [**apiV2RegistrationsYearsofresidencyStudentStudentNoGet()**](RegistrationsApi.md#apiV2RegistrationsYearsofresidencyStudentStudentNoGet) | **GET** /api/v2/Registrations/yearsofresidency/student/{studentNo} | Counts the number of years |


## `apiV2RegistrationsBalanceStudentNoGet()`

```php
apiV2RegistrationsBalanceStudentNoGet($student_no, $tenant_id)
```

Get total student balance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsBalanceStudentNoGet($student_no, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsBalanceStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
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

## `apiV2RegistrationsBystudentStudentNoTermTermIdGet()`

```php
apiV2RegistrationsBystudentStudentNoTermTermIdGet($student_no, $term_id, $tenant_id)
```

Get student registration record by term

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$term_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsBystudentStudentNoTermTermIdGet($student_no, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsBystudentStudentNoTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **term_id** | **int**|  | |
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

## `apiV2RegistrationsCorrectemailsfromgoogletostudentPut()`

```php
apiV2RegistrationsCorrectemailsfromgoogletostudentPut($tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2RegistrationsCorrectemailsfromgoogletostudentPut($tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsCorrectemailsfromgoogletostudentPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
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

## `apiV2RegistrationsCorrectemailsofstudentsTermIdPut()`

```php
apiV2RegistrationsCorrectemailsofstudentsTermIdPut($term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2RegistrationsCorrectemailsofstudentsTermIdPut($term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsCorrectemailsofstudentsTermIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
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

## `apiV2RegistrationsGetAllRegistrationsStudentNoGet()`

```php
apiV2RegistrationsGetAllRegistrationsStudentNoGet($student_no, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2RegistrationsGetAllRegistrationsStudentNoGet($student_no, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsGetAllRegistrationsStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
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

## `apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet()`

```php
apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet($reg_id, $student_no, $term_id, $tenant_id)
```

Verify student registration

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$reg_id = 56; // int | 
$student_no = 'student_no_example'; // string | 
$term_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet($reg_id, $student_no, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsRegIdGetStudentStudentNoTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **reg_id** | **int**|  | |
| **student_no** | **string**|  | |
| **term_id** | **int**|  | |
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

## `apiV2RegistrationsSchedulesStudentNoTermIdGet()`

```php
apiV2RegistrationsSchedulesStudentNoTermIdGet($student_no, $term_id, $tenant_id)
```

get schedules by term and campus

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$term_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsSchedulesStudentNoTermIdGet($student_no, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsSchedulesStudentNoTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **term_id** | **int**|  | |
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

## `apiV2RegistrationsStudentAccountabilitiesStudentNoGet()`

```php
apiV2RegistrationsStudentAccountabilitiesStudentNoGet($student_no, $tenant_id)
```

Get all outstanding Accountabilities

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsStudentAccountabilitiesStudentNoGet($student_no, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsStudentAccountabilitiesStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
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

## `apiV2RegistrationsTermTermIdStudentStudentNoGet()`

```php
apiV2RegistrationsTermTermIdStudentStudentNoGet($term_id, $student_no, $tenant_id)
```

Get student section

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$student_no = 'student_no_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsTermTermIdStudentStudentNoGet($term_id, $student_no, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsTermTermIdStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **student_no** | **string**|  | |
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

## `apiV2RegistrationsTotalernrolledTermTermIdGet()`

```php
apiV2RegistrationsTotalernrolledTermTermIdGet($term_id, $tenant_id)
```

Counts all enrolled students based on campus and term

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2RegistrationsTotalernrolledTermTermIdGet($term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsTotalernrolledTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
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

## `apiV2RegistrationsYearsofresidencyStudentStudentNoGet()`

```php
apiV2RegistrationsYearsofresidencyStudentStudentNoGet($student_no, $tenant_id)
```

Counts the number of years

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\RegistrationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2RegistrationsYearsofresidencyStudentStudentNoGet($student_no, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling RegistrationsApi->apiV2RegistrationsYearsofresidencyStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
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
