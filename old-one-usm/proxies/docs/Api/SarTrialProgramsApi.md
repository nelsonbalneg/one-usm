# OpenAPI\Client\SarTrialProgramsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarSarTrialProgramsByStudentStudentNoGet()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsByStudentStudentNoGet) | **GET** /api/v2/sar/SarTrialPrograms/by-student/{studentNo} | Get the trial program by studentNo |
| [**apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet) | **GET** /api/v2/sar/SarTrialPrograms/by-student/{studentNo}/{termId} |  |
| [**apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet) | **GET** /api/v2/sar/SarTrialPrograms/count-all-enrolled-through-sar/{mainTermId}/{kccTermId} | Count of all Enrollments through SAR |
| [**apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet) | **GET** /api/v2/sar/SarTrialPrograms/countAllSarRegs/{mainTermId}/{kccTermId} | Count all SAR registrations by term |
| [**apiV2SarSarTrialProgramsDatatablePagedGet()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsDatatablePagedGet) | **GET** /api/v2/sar/SarTrialPrograms/datatable/paged |  |
| [**apiV2SarSarTrialProgramsIdCancelPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdCancelPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/cancel |  |
| [**apiV2SarSarTrialProgramsIdEnroll2UserIdPost()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdEnroll2UserIdPost) | **POST** /api/v2/sar/SarTrialPrograms/{id}/enroll2/{userId} |  |
| [**apiV2SarSarTrialProgramsIdEnrollPost()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdEnrollPost) | **POST** /api/v2/sar/SarTrialPrograms/{id}/enroll | Enroll the student using TrialProgramId |
| [**apiV2SarSarTrialProgramsIdProfileClassSectionPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileClassSectionPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/class-section |  |
| [**apiV2SarSarTrialProgramsIdProfileCurriculumPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileCurriculumPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/curriculum |  |
| [**apiV2SarSarTrialProgramsIdProfileGrantTemplatePut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileGrantTemplatePut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/grant-template |  |
| [**apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/max-load-unit/{maxLoadUnits} |  |
| [**apiV2SarSarTrialProgramsIdProfileProgramPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileProgramPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/program |  |
| [**apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/residency-only/{value} |  |
| [**apiV2SarSarTrialProgramsIdProfileSchoProviderPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileSchoProviderPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/scho-provider |  |
| [**apiV2SarSarTrialProgramsIdProfileTableOfFeePut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileTableOfFeePut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/table-of-fee |  |
| [**apiV2SarSarTrialProgramsIdProfileYearLevelPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdProfileYearLevelPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/profile/year-level |  |
| [**apiV2SarSarTrialProgramsIdSetTransactionTypePost()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdSetTransactionTypePost) | **POST** /api/v2/sar/SarTrialPrograms/{id}/set-transaction-type |  |
| [**apiV2SarSarTrialProgramsIdSubmitPut()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsIdSubmitPut) | **PUT** /api/v2/sar/SarTrialPrograms/{id}/submit |  |
| [**apiV2SarSarTrialProgramsPost()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsPost) | **POST** /api/v2/sar/SarTrialPrograms |  |
| [**apiV2SarSarTrialProgramsSyncPatch()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsSyncPatch) | **PATCH** /api/v2/sar/SarTrialPrograms/sync |  |
| [**apiV2SarSarTrialProgramsSyncTpEnrollmentPatch()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsSyncTpEnrollmentPatch) | **PATCH** /api/v2/sar/SarTrialPrograms/sync-tp-enrollment |  |
| [**apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch()**](SarTrialProgramsApi.md#apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch) | **PATCH** /api/v2/sar/SarTrialPrograms/sync-tp-enrollment/{termId} |  |
| [**getTrialProgram()**](SarTrialProgramsApi.md#getTrialProgram) | **GET** /api/v2/sar/SarTrialPrograms/{id} |  |


## `apiV2SarSarTrialProgramsByStudentStudentNoGet()`

```php
apiV2SarSarTrialProgramsByStudentStudentNoGet($student_no, $tenant_id)
```

Get the trial program by studentNo

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2SarSarTrialProgramsByStudentStudentNoGet($student_no, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsByStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet()`

```php
apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet($student_no, $term_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$term_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet($student_no, $term_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsByStudentStudentNoTermIdGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet()`

```php
apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet($main_term_id, $kcc_term_id)
```

Count of all Enrollments through SAR

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$main_term_id = 56; // int | 
$kcc_term_id = 56; // int | 

try {
    $apiInstance->apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet($main_term_id, $kcc_term_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsCountAllEnrolledThroughSarMainTermIdKccTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **main_term_id** | **int**|  | |
| **kcc_term_id** | **int**|  | |

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

## `apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet()`

```php
apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet($main_term_id, $kcc_term_id)
```

Count all SAR registrations by term

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$main_term_id = 56; // int | 
$kcc_term_id = 56; // int | 

try {
    $apiInstance->apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet($main_term_id, $kcc_term_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsCountAllSarRegsMainTermIdKccTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **main_term_id** | **int**|  | |
| **kcc_term_id** | **int**|  | |

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

## `apiV2SarSarTrialProgramsDatatablePagedGet()`

```php
apiV2SarSarTrialProgramsDatatablePagedGet($row, $page_size, $keyword, $campus_id, $term_id, $program_id, $major_id, $status, $transaction_type)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$row = 56; // int
$page_size = 56; // int
$keyword = 'keyword_example'; // string
$campus_id = 56; // int
$term_id = 56; // int
$program_id = 56; // int
$major_id = 56; // int
$status = 'status_example'; // string
$transaction_type = 'transaction_type_example'; // string

try {
    $apiInstance->apiV2SarSarTrialProgramsDatatablePagedGet($row, $page_size, $keyword, $campus_id, $term_id, $program_id, $major_id, $status, $transaction_type);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsDatatablePagedGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **row** | **int**|  | [optional] |
| **page_size** | **int**|  | [optional] |
| **keyword** | **string**|  | [optional] |
| **campus_id** | **int**|  | [optional] |
| **term_id** | **int**|  | [optional] |
| **program_id** | **int**|  | [optional] |
| **major_id** | **int**|  | [optional] |
| **status** | **string**|  | [optional] |
| **transaction_type** | **string**|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdCancelPut()`

```php
apiV2SarSarTrialProgramsIdCancelPut($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->apiV2SarSarTrialProgramsIdCancelPut($id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdCancelPut: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramsIdEnroll2UserIdPost()`

```php
apiV2SarSarTrialProgramsIdEnroll2UserIdPost($id, $user_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$user_id = 'user_id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2SarSarTrialProgramsIdEnroll2UserIdPost($id, $user_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdEnroll2UserIdPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **user_id** | **string**|  | |
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

## `apiV2SarSarTrialProgramsIdEnrollPost()`

```php
apiV2SarSarTrialProgramsIdEnrollPost($id, $tenant_id)
```

Enroll the student using TrialProgramId

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 

try {
    $apiInstance->apiV2SarSarTrialProgramsIdEnrollPost($id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdEnrollPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
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

## `apiV2SarSarTrialProgramsIdProfileClassSectionPut()`

```php
apiV2SarSarTrialProgramsIdProfileClassSectionPut($id, $tenant_id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileClassSectionPut($id, $tenant_id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileClassSectionPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdProfileCurriculumPut()`

```php
apiV2SarSarTrialProgramsIdProfileCurriculumPut($id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileCurriculumPut($id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileCurriculumPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdProfileGrantTemplatePut()`

```php
apiV2SarSarTrialProgramsIdProfileGrantTemplatePut($id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileGrantTemplatePut($id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileGrantTemplatePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut()`

```php
apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut($id, $max_load_units)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$max_load_units = 56; // int

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut($id, $max_load_units);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileMaxLoadUnitMaxLoadUnitsPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **max_load_units** | **int**|  | |

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

## `apiV2SarSarTrialProgramsIdProfileProgramPut()`

```php
apiV2SarSarTrialProgramsIdProfileProgramPut($id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileProgramPut($id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileProgramPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut()`

```php
apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut($id, $value)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$value = True; // bool

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut($id, $value);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileResidencyOnlyValuePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **value** | **bool**|  | |

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

## `apiV2SarSarTrialProgramsIdProfileSchoProviderPut()`

```php
apiV2SarSarTrialProgramsIdProfileSchoProviderPut($id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileSchoProviderPut($id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileSchoProviderPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdProfileTableOfFeePut()`

```php
apiV2SarSarTrialProgramsIdProfileTableOfFeePut($id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileTableOfFeePut($id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileTableOfFeePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdProfileYearLevelPut()`

```php
apiV2SarSarTrialProgramsIdProfileYearLevelPut($id, $sar_profile_update_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$sar_profile_update_input = new \OpenAPI\Client\Model\SarProfileUpdateInput(); // \OpenAPI\Client\Model\SarProfileUpdateInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdProfileYearLevelPut($id, $sar_profile_update_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdProfileYearLevelPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **sar_profile_update_input** | [**\OpenAPI\Client\Model\SarProfileUpdateInput**](../Model/SarProfileUpdateInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdSetTransactionTypePost()`

```php
apiV2SarSarTrialProgramsIdSetTransactionTypePost($id, $set_trial_program_trans_type_input)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$set_trial_program_trans_type_input = new \OpenAPI\Client\Model\SetTrialProgramTransTypeInput(); // \OpenAPI\Client\Model\SetTrialProgramTransTypeInput

try {
    $apiInstance->apiV2SarSarTrialProgramsIdSetTransactionTypePost($id, $set_trial_program_trans_type_input);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdSetTransactionTypePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **set_trial_program_trans_type_input** | [**\OpenAPI\Client\Model\SetTrialProgramTransTypeInput**](../Model/SetTrialProgramTransTypeInput.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsIdSubmitPut()`

```php
apiV2SarSarTrialProgramsIdSubmitPut($id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int

try {
    $apiInstance->apiV2SarSarTrialProgramsIdSubmitPut($id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsIdSubmitPut: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramsPost()`

```php
apiV2SarSarTrialProgramsPost($tenant_id, $trial_program_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$trial_program_dto = new \OpenAPI\Client\Model\TrialProgramDto(); // \OpenAPI\Client\Model\TrialProgramDto

try {
    $apiInstance->apiV2SarSarTrialProgramsPost($tenant_id, $trial_program_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **trial_program_dto** | [**\OpenAPI\Client\Model\TrialProgramDto**](../Model/TrialProgramDto.md)|  | [optional] |

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

## `apiV2SarSarTrialProgramsSyncPatch()`

```php
apiV2SarSarTrialProgramsSyncPatch()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2SarSarTrialProgramsSyncPatch();
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsSyncPatch: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramsSyncTpEnrollmentPatch()`

```php
apiV2SarSarTrialProgramsSyncTpEnrollmentPatch()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2SarSarTrialProgramsSyncTpEnrollmentPatch();
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsSyncTpEnrollmentPatch: ', $e->getMessage(), PHP_EOL;
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

## `apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch()`

```php
apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch($term_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int

try {
    $apiInstance->apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch($term_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->apiV2SarSarTrialProgramsSyncTpEnrollmentTermIdPatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
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

## `getTrialProgram()`

```php
getTrialProgram($id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarTrialProgramsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->getTrialProgram($id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling SarTrialProgramsApi->getTrialProgram: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
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
