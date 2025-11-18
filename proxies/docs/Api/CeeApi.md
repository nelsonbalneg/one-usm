# OpenAPI\Client\CeeApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2CeeCommitRankingListByPolicyPolicyIdGet()**](CeeApi.md#apiV2CeeCommitRankingListByPolicyPolicyIdGet) | **GET** /api/v2/Cee/commit-ranking-list-by-policy/{policyId} | Displays list of applicants ranked on CSA, Part 1, then Part 2 |
| [**apiV2CeeGetListGet()**](CeeApi.md#apiV2CeeGetListGet) | **GET** /api/v2/Cee/get-list |  |
| [**apiV2CeeGetRankedListByPolicyPolicyIdGet()**](CeeApi.md#apiV2CeeGetRankedListByPolicyPolicyIdGet) | **GET** /api/v2/Cee/get-ranked-list-by-policy/{policyId} | Displays list of applicants ranked on CSA, Part 1, then Part 2 |
| [**apiV2CeeRankApplicantsForAllPoliciesByTermsPost()**](CeeApi.md#apiV2CeeRankApplicantsForAllPoliciesByTermsPost) | **POST** /api/v2/Cee/rank-applicants-for-all-policies-by-terms |  |
| [**apiV2CeeResetApplicantAppNoPost()**](CeeApi.md#apiV2CeeResetApplicantAppNoPost) | **POST** /api/v2/Cee/reset-applicant/{appNo} |  |
| [**apiV2CeeResultByApplicant2ndPriorityApplicantIdGet()**](CeeApi.md#apiV2CeeResultByApplicant2ndPriorityApplicantIdGet) | **GET** /api/v2/Cee/result-by-applicant-2nd-priority/{applicantId} | Use this for the 2nd priority. Programs are based on specialization kung pasado xa at may bakante pa. |
| [**apiV2CeeResultByApplicant3rdPriorityApplicantIdGet()**](CeeApi.md#apiV2CeeResultByApplicant3rdPriorityApplicantIdGet) | **GET** /api/v2/Cee/result-by-applicant-3rd-priority/{applicantId} | Use this if program selection is based on CSA cutoff regardless of specialization. |
| [**apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet()**](CeeApi.md#apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet) | **GET** /api/v2/Cee/result-by-applicant-allowed-tec-with-ranking/{applicantId} | Pwede na tumawid ang SEM, BAM at HED sa TEC also added if a program is ranked |
| [**apiV2CeeResultByApplicantApplicantIdGet()**](CeeApi.md#apiV2CeeResultByApplicantApplicantIdGet) | **GET** /api/v2/Cee/result-by-applicant/{applicantId} | Endpoint for First Priority only. |
| [**apiV2CeeStudentsAppNoGet()**](CeeApi.md#apiV2CeeStudentsAppNoGet) | **GET** /api/v2/Cee/students/{appNo} |  |
| [**apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet()**](CeeApi.md#apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet) | **GET** /api/v2/Cee/totals/real-campus/{realCampusId}/term/{termId} | Reservation Totals (Real Campus) |


## `apiV2CeeCommitRankingListByPolicyPolicyIdGet()`

```php
apiV2CeeCommitRankingListByPolicyPolicyIdGet($policy_id)
```

Displays list of applicants ranked on CSA, Part 1, then Part 2

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 

try {
    $apiInstance->apiV2CeeCommitRankingListByPolicyPolicyIdGet($policy_id);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeCommitRankingListByPolicyPolicyIdGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2CeeGetListGet()`

```php
apiV2CeeGetListGet($keyword, $page, $page_size)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$keyword = ''; // string
$page = 1; // int
$page_size = 10; // int

try {
    $apiInstance->apiV2CeeGetListGet($keyword, $page, $page_size);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeGetListGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2CeeGetRankedListByPolicyPolicyIdGet()`

```php
apiV2CeeGetRankedListByPolicyPolicyIdGet($policy_id)
```

Displays list of applicants ranked on CSA, Part 1, then Part 2

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 

try {
    $apiInstance->apiV2CeeGetRankedListByPolicyPolicyIdGet($policy_id);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeGetRankedListByPolicyPolicyIdGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2CeeRankApplicantsForAllPoliciesByTermsPost()`

```php
apiV2CeeRankApplicantsForAllPoliciesByTermsPost($request_body)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = array(56); // int[]

try {
    $apiInstance->apiV2CeeRankApplicantsForAllPoliciesByTermsPost($request_body);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeRankApplicantsForAllPoliciesByTermsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**int[]**](../Model/int.md)|  | [optional] |

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

## `apiV2CeeResetApplicantAppNoPost()`

```php
apiV2CeeResetApplicantAppNoPost($app_no)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_no = 'app_no_example'; // string

try {
    $apiInstance->apiV2CeeResetApplicantAppNoPost($app_no);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeResetApplicantAppNoPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **app_no** | **string**|  | |

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

## `apiV2CeeResultByApplicant2ndPriorityApplicantIdGet()`

```php
apiV2CeeResultByApplicant2ndPriorityApplicantIdGet($applicant_id): \OpenAPI\Client\Model\ResultByApplicantView
```

Use this for the 2nd priority. Programs are based on specialization kung pasado xa at may bakante pa.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$applicant_id = 56; // int | 

try {
    $result = $apiInstance->apiV2CeeResultByApplicant2ndPriorityApplicantIdGet($applicant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeResultByApplicant2ndPriorityApplicantIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **applicant_id** | **int**|  | |

### Return type

[**\OpenAPI\Client\Model\ResultByApplicantView**](../Model/ResultByApplicantView.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2CeeResultByApplicant3rdPriorityApplicantIdGet()`

```php
apiV2CeeResultByApplicant3rdPriorityApplicantIdGet($applicant_id): \OpenAPI\Client\Model\ResultByApplicantDto
```

Use this if program selection is based on CSA cutoff regardless of specialization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$applicant_id = 56; // int | 

try {
    $result = $apiInstance->apiV2CeeResultByApplicant3rdPriorityApplicantIdGet($applicant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeResultByApplicant3rdPriorityApplicantIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **applicant_id** | **int**|  | |

### Return type

[**\OpenAPI\Client\Model\ResultByApplicantDto**](../Model/ResultByApplicantDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet()`

```php
apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet($applicant_id): \OpenAPI\Client\Model\ResultByApplicantView
```

Pwede na tumawid ang SEM, BAM at HED sa TEC also added if a program is ranked

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$applicant_id = 56; // int | 

try {
    $result = $apiInstance->apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet($applicant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeResultByApplicantAllowedTecWithRankingApplicantIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **applicant_id** | **int**|  | |

### Return type

[**\OpenAPI\Client\Model\ResultByApplicantView**](../Model/ResultByApplicantView.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2CeeResultByApplicantApplicantIdGet()`

```php
apiV2CeeResultByApplicantApplicantIdGet($applicant_id): \OpenAPI\Client\Model\ResultByApplicantDto
```

Endpoint for First Priority only.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$applicant_id = 56; // int | 

try {
    $result = $apiInstance->apiV2CeeResultByApplicantApplicantIdGet($applicant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeResultByApplicantApplicantIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **applicant_id** | **int**|  | |

### Return type

[**\OpenAPI\Client\Model\ResultByApplicantDto**](../Model/ResultByApplicantDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2CeeStudentsAppNoGet()`

```php
apiV2CeeStudentsAppNoGet($app_no): \OpenAPI\Client\Model\CeeStudentDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_no = 'app_no_example'; // string

try {
    $result = $apiInstance->apiV2CeeStudentsAppNoGet($app_no);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeStudentsAppNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **app_no** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\CeeStudentDto**](../Model/CeeStudentDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet()`

```php
apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id)
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


$apiInstance = new OpenAPI\Client\Api\CeeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$real_campus_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet($real_campus_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling CeeApi->apiV2CeeTotalsRealCampusRealCampusIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
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
