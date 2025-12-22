# OpenAPI\Client\ProgramPoliciesApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet) | **GET** /api/v2/ProgramPolicies/college/{collegeId}/term/{termId} | Filter by college and term |
| [**apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet) | **GET** /api/v2/ProgramPolicies/counterbycollege/{collegeId}/campus/{campusId}/term/{termId}/program/{programId} | Counts the total slots per program |
| [**apiV2ProgramPoliciesExistsGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesExistsGet) | **GET** /api/v2/ProgramPolicies/exists | Check if a policy already exists |
| [**apiV2ProgramPoliciesFilterGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesFilterGet) | **GET** /api/v2/ProgramPolicies/filter | Filter policies based on cee score, gpa, type, progid, or campusname |
| [**apiV2ProgramPoliciesFilterbyceeandcampusGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesFilterbyceeandcampusGet) | **GET** /api/v2/ProgramPolicies/filterbyceeandcampus |  |
| [**apiV2ProgramPoliciesGpafilterGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesGpafilterGet) | **GET** /api/v2/ProgramPolicies/gpafilter | Filter by gpa |
| [**apiV2ProgramPoliciesIdAddonePost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesIdAddonePost) | **POST** /api/v2/ProgramPolicies/{id}/addone | Adds 1 admission to the admitted slot |
| [**apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost) | **POST** /api/v2/ProgramPolicies/{id}/addpendingslots/{slotsToAdd} | Add number of slots for pending limit |
| [**apiV2ProgramPoliciesIdAddslotsSlotsToAddPost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesIdAddslotsSlotsToAddPost) | **POST** /api/v2/ProgramPolicies/{id}/addslots/{slotsToAdd} | Add 1 to slot limits |
| [**apiV2ProgramPoliciesIdLessonePost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesIdLessonePost) | **POST** /api/v2/ProgramPolicies/{id}/lessone | Subtracts 1 to admission count |
| [**apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost) | **POST** /api/v2/ProgramPolicies/{id}/subtractpendingslots/{slotsToSubtract} | subtract pending limits |
| [**apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost) | **POST** /api/v2/ProgramPolicies/{id}/subtractslots/{slotsToSubtract} | Subtract 1 to slot limits |
| [**apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet) | **GET** /api/v2/ProgramPolicies/list-bs/term/{termId}/campus/{campusId} | Get Bachelor programs |
| [**apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet) | **GET** /api/v2/ProgramPolicies/list-gs/term/{termId}/campus/{campusId} | Get policies for grad school |
| [**apiV2ProgramPoliciesListStatusGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListStatusGet) | **GET** /api/v2/ProgramPolicies/list/status | Total count of applicant status |
| [**apiV2ProgramPoliciesListStatusPermunicipalityGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListStatusPermunicipalityGet) | **GET** /api/v2/ProgramPolicies/list/status/permunicipality | Total count per municipality |
| [**apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/campus/{campusId}/cee/{ceeScore} | Filter on first Priority |
| [**apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/campus/{campusId} | Filter by term and campus with totals |
| [**apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/real-campus/{realCampusId}/cee/{ceeScore} | Filter on real campus id |
| [**apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet) | **GET** /api/v2/ProgramPolicies/list/term/{termId}/realcampus/{realCampusId} | Filter by term and real campus with totals |
| [**apiV2ProgramPoliciesListallGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListallGet) | **GET** /api/v2/ProgramPolicies/listall | List of all policies |
| [**apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet) | **GET** /api/v2/ProgramPolicies/listbytermandcee/{termId}/{ceeScore} | List of policies by term and cee score |
| [**apiV2ProgramPoliciesPolicyIdRequirehepabtestPut()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesPolicyIdRequirehepabtestPut) | **PUT** /api/v2/ProgramPolicies/{policyId}/requirehepabtest | Switch for requiring hepa b test |
| [**apiV2ProgramPoliciesPolicyIdSetcutoffscorePut()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesPolicyIdSetcutoffscorePut) | **PUT** /api/v2/ProgramPolicies/{policyId}/setcutoffscore | Update cutoff score |
| [**apiV2ProgramPoliciesPolicyIdSetstatusPut()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesPolicyIdSetstatusPut) | **PUT** /api/v2/ProgramPolicies/{policyId}/setstatus | Update policy status |
| [**apiV2ProgramPoliciesPost()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesPost) | **POST** /api/v2/ProgramPolicies | Create a policy |
| [**apiV2ProgramPoliciesPut()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesPut) | **PUT** /api/v2/ProgramPolicies | Update a policy |
| [**apiV2ProgramPoliciesRemainingslotsGet()**](ProgramPoliciesApi.md#apiV2ProgramPoliciesRemainingslotsGet) | **GET** /api/v2/ProgramPolicies/remainingslots | Get the remaining slots |
| [**getPolicy()**](ProgramPoliciesApi.md#getPolicy) | **GET** /api/v2/ProgramPolicies/{progPolicyId} | Get a policy by Id |


## `apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet()`

```php
apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet($college_id, $term_id)
```

Filter by college and term

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$college_id = 56; // int | 
$term_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet($college_id, $term_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesCollegeCollegeIdTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **college_id** | **int**|  | |
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

## `apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet()`

```php
apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet($term_id, $college_id, $campus_id, $program_id)
```

Counts the total slots per program

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$college_id = 56; // int | 
$campus_id = 56; // int | 
$program_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet($term_id, $college_id, $campus_id, $program_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesCounterbycollegeCollegeIdCampusCampusIdTermTermIdProgramProgramIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **college_id** | **int**|  | |
| **campus_id** | **int**|  | |
| **program_id** | **int**|  | |

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

## `apiV2ProgramPoliciesExistsGet()`

```php
apiV2ProgramPoliciesExistsGet($term_id, $campus_id, $prog_id, $major_disc_id)
```

Check if a policy already exists

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$campus_id = 56; // int
$prog_id = 56; // int
$major_disc_id = 56; // int

try {
    $apiInstance->apiV2ProgramPoliciesExistsGet($term_id, $campus_id, $prog_id, $major_disc_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesExistsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | [optional] |
| **campus_id** | **int**|  | [optional] |
| **prog_id** | **int**|  | [optional] |
| **major_disc_id** | **int**|  | [optional] |

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

## `apiV2ProgramPoliciesFilterGet()`

```php
apiV2ProgramPoliciesFilterGet($cee_score, $gpa, $type, $prog_id, $campus_name, $specialization_code, $tenant_id)
```

Filter policies based on cee score, gpa, type, progid, or campusname

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cee_score = 56; // int
$gpa = 3.4; // float
$type = 'type_example'; // string
$prog_id = 56; // int
$campus_name = 'campus_name_example'; // string
$specialization_code = 'specialization_code_example'; // string
$tenant_id = 56; // int

try {
    $apiInstance->apiV2ProgramPoliciesFilterGet($cee_score, $gpa, $type, $prog_id, $campus_name, $specialization_code, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesFilterGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **cee_score** | **int**|  | [optional] |
| **gpa** | **float**|  | [optional] |
| **type** | **string**|  | [optional] |
| **prog_id** | **int**|  | [optional] |
| **campus_name** | **string**|  | [optional] |
| **specialization_code** | **string**|  | [optional] |
| **tenant_id** | **int**|  | [optional] |

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

## `apiV2ProgramPoliciesFilterbyceeandcampusGet()`

```php
apiV2ProgramPoliciesFilterbyceeandcampusGet($cee_score, $gpa, $type, $prog_id, $campus_name, $specialization_code, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cee_score = 56; // int
$gpa = 3.4; // float
$type = 'type_example'; // string
$prog_id = 56; // int
$campus_name = 'campus_name_example'; // string
$specialization_code = 'specialization_code_example'; // string
$tenant_id = 56; // int

try {
    $apiInstance->apiV2ProgramPoliciesFilterbyceeandcampusGet($cee_score, $gpa, $type, $prog_id, $campus_name, $specialization_code, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesFilterbyceeandcampusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **cee_score** | **int**|  | [optional] |
| **gpa** | **float**|  | [optional] |
| **type** | **string**|  | [optional] |
| **prog_id** | **int**|  | [optional] |
| **campus_name** | **string**|  | [optional] |
| **specialization_code** | **string**|  | [optional] |
| **tenant_id** | **int**|  | [optional] |

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

## `apiV2ProgramPoliciesGpafilterGet()`

```php
apiV2ProgramPoliciesGpafilterGet($cee_score, $gpa, $type, $prog_id, $campus_name, $specialization_code, $tenant_id)
```

Filter by gpa

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cee_score = 56; // int
$gpa = 3.4; // float
$type = 'type_example'; // string
$prog_id = 56; // int
$campus_name = 'campus_name_example'; // string
$specialization_code = 'specialization_code_example'; // string
$tenant_id = 56; // int

try {
    $apiInstance->apiV2ProgramPoliciesGpafilterGet($cee_score, $gpa, $type, $prog_id, $campus_name, $specialization_code, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesGpafilterGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **cee_score** | **int**|  | [optional] |
| **gpa** | **float**|  | [optional] |
| **type** | **string**|  | [optional] |
| **prog_id** | **int**|  | [optional] |
| **campus_name** | **string**|  | [optional] |
| **specialization_code** | **string**|  | [optional] |
| **tenant_id** | **int**|  | [optional] |

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

## `apiV2ProgramPoliciesIdAddonePost()`

```php
apiV2ProgramPoliciesIdAddonePost($id)
```

Adds 1 admission to the admitted slot

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesIdAddonePost($id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesIdAddonePost: ', $e->getMessage(), PHP_EOL;
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

## `apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost()`

```php
apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost($id, $slots_to_add)
```

Add number of slots for pending limit

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 
$slots_to_add = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost($id, $slots_to_add);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesIdAddpendingslotsSlotsToAddPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **slots_to_add** | **int**|  | |

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

## `apiV2ProgramPoliciesIdAddslotsSlotsToAddPost()`

```php
apiV2ProgramPoliciesIdAddslotsSlotsToAddPost($id, $slots_to_add)
```

Add 1 to slot limits

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 
$slots_to_add = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesIdAddslotsSlotsToAddPost($id, $slots_to_add);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesIdAddslotsSlotsToAddPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **slots_to_add** | **int**|  | |

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

## `apiV2ProgramPoliciesIdLessonePost()`

```php
apiV2ProgramPoliciesIdLessonePost($id)
```

Subtracts 1 to admission count

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesIdLessonePost($id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesIdLessonePost: ', $e->getMessage(), PHP_EOL;
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

## `apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost()`

```php
apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost($id, $slots_to_subtract)
```

subtract pending limits

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 
$slots_to_subtract = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost($id, $slots_to_subtract);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesIdSubtractpendingslotsSlotsToSubtractPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **slots_to_subtract** | **int**|  | |

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

## `apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost()`

```php
apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost($id, $slots_to_subtract)
```

Subtract 1 to slot limits

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | 
$slots_to_subtract = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost($id, $slots_to_subtract);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesIdSubtractslotsSlotsToSubtractPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **int**|  | |
| **slots_to_subtract** | **int**|  | |

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

## `apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet()`

```php
apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet($term_id, $campus_id)
```

Get Bachelor programs

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$campus_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet($term_id, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListBsTermTermIdCampusCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
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

## `apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet()`

```php
apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet($term_id, $campus_id)
```

Get policies for grad school

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$campus_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet($term_id, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListGsTermTermIdCampusCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
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

## `apiV2ProgramPoliciesListStatusGet()`

```php
apiV2ProgramPoliciesListStatusGet($main_campus_term_id, $kcc_term_id)
```

Total count of applicant status

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$main_campus_term_id = 56; // int | 
$kcc_term_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListStatusGet($main_campus_term_id, $kcc_term_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **main_campus_term_id** | **int**|  | [optional] |
| **kcc_term_id** | **int**|  | [optional] |

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

## `apiV2ProgramPoliciesListStatusPermunicipalityGet()`

```php
apiV2ProgramPoliciesListStatusPermunicipalityGet($municipality_code)
```

Total count per municipality

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$municipality_code = 'municipality_code_example'; // string | 

try {
    $apiInstance->apiV2ProgramPoliciesListStatusPermunicipalityGet($municipality_code);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListStatusPermunicipalityGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **municipality_code** | **string**|  | [optional] |

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

## `apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet()`

```php
apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet($term_id, $campus_id, $cee_score)
```

Filter on first Priority

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$campus_id = 56; // int | 
$cee_score = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet($term_id, $campus_id, $cee_score);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListTermTermIdCampusCampusIdCeeCeeScoreGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **campus_id** | **int**|  | |
| **cee_score** | **int**|  | |

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

## `apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet()`

```php
apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet($term_id, $campus_id)
```

Filter by term and campus with totals

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$campus_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet($term_id, $campus_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListTermTermIdCampusCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
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

## `apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet()`

```php
apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet($term_id, $real_campus_id, $cee_score)
```

Filter on real campus id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$real_campus_id = 56; // int | 
$cee_score = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet($term_id, $real_campus_id, $cee_score);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListTermTermIdRealCampusRealCampusIdCeeCeeScoreGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **real_campus_id** | **int**|  | |
| **cee_score** | **int**|  | |

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

## `apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet()`

```php
apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet($term_id, $real_campus_id)
```

Filter by term and real campus with totals

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$real_campus_id = 1; // int

try {
    $apiInstance->apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet($term_id, $real_campus_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **real_campus_id** | **int**|  | [default to 1] |

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

## `apiV2ProgramPoliciesListallGet()`

```php
apiV2ProgramPoliciesListallGet()
```

List of all policies

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2ProgramPoliciesListallGet();
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListallGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet()`

```php
apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet($term_id, $cee_score)
```

List of policies by term and cee score

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$cee_score = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet($term_id, $cee_score);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesListbytermandceeTermIdCeeScoreGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **cee_score** | **int**|  | |

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

## `apiV2ProgramPoliciesPolicyIdRequirehepabtestPut()`

```php
apiV2ProgramPoliciesPolicyIdRequirehepabtestPut($policy_id, $policy_controller_require_hepa_test_dto)
```

Switch for requiring hepa b test

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 
$policy_controller_require_hepa_test_dto = new \OpenAPI\Client\Model\PolicyControllerRequireHepaTestDto(); // \OpenAPI\Client\Model\PolicyControllerRequireHepaTestDto | 

try {
    $apiInstance->apiV2ProgramPoliciesPolicyIdRequirehepabtestPut($policy_id, $policy_controller_require_hepa_test_dto);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesPolicyIdRequirehepabtestPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **policy_id** | **int**|  | |
| **policy_controller_require_hepa_test_dto** | [**\OpenAPI\Client\Model\PolicyControllerRequireHepaTestDto**](../Model/PolicyControllerRequireHepaTestDto.md)|  | [optional] |

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

## `apiV2ProgramPoliciesPolicyIdSetcutoffscorePut()`

```php
apiV2ProgramPoliciesPolicyIdSetcutoffscorePut($policy_id, $policy_controller_set_cut_off_score_dto)
```

Update cutoff score

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 
$policy_controller_set_cut_off_score_dto = new \OpenAPI\Client\Model\PolicyControllerSetCutOffScoreDto(); // \OpenAPI\Client\Model\PolicyControllerSetCutOffScoreDto | 

try {
    $apiInstance->apiV2ProgramPoliciesPolicyIdSetcutoffscorePut($policy_id, $policy_controller_set_cut_off_score_dto);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesPolicyIdSetcutoffscorePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **policy_id** | **int**|  | |
| **policy_controller_set_cut_off_score_dto** | [**\OpenAPI\Client\Model\PolicyControllerSetCutOffScoreDto**](../Model/PolicyControllerSetCutOffScoreDto.md)|  | [optional] |

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

## `apiV2ProgramPoliciesPolicyIdSetstatusPut()`

```php
apiV2ProgramPoliciesPolicyIdSetstatusPut($policy_id, $policy_controller_set_status_dto)
```

Update policy status

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$policy_id = 56; // int | 
$policy_controller_set_status_dto = new \OpenAPI\Client\Model\PolicyControllerSetStatusDto(); // \OpenAPI\Client\Model\PolicyControllerSetStatusDto | 

try {
    $apiInstance->apiV2ProgramPoliciesPolicyIdSetstatusPut($policy_id, $policy_controller_set_status_dto);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesPolicyIdSetstatusPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **policy_id** | **int**|  | |
| **policy_controller_set_status_dto** | [**\OpenAPI\Client\Model\PolicyControllerSetStatusDto**](../Model/PolicyControllerSetStatusDto.md)|  | [optional] |

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

## `apiV2ProgramPoliciesPost()`

```php
apiV2ProgramPoliciesPost($program_policy_dto)
```

Create a policy

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$program_policy_dto = new \OpenAPI\Client\Model\ProgramPolicyDto(); // \OpenAPI\Client\Model\ProgramPolicyDto | 

try {
    $apiInstance->apiV2ProgramPoliciesPost($program_policy_dto);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **program_policy_dto** | [**\OpenAPI\Client\Model\ProgramPolicyDto**](../Model/ProgramPolicyDto.md)|  | [optional] |

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

## `apiV2ProgramPoliciesPut()`

```php
apiV2ProgramPoliciesPut($program_policy_dto)
```

Update a policy

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$program_policy_dto = new \OpenAPI\Client\Model\ProgramPolicyDto(); // \OpenAPI\Client\Model\ProgramPolicyDto | 

try {
    $apiInstance->apiV2ProgramPoliciesPut($program_policy_dto);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **program_policy_dto** | [**\OpenAPI\Client\Model\ProgramPolicyDto**](../Model/ProgramPolicyDto.md)|  | [optional] |

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

## `apiV2ProgramPoliciesRemainingslotsGet()`

```php
apiV2ProgramPoliciesRemainingslotsGet($term_id, $prog_id)
```

Get the remaining slots

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int | 
$prog_id = 56; // int | 

try {
    $apiInstance->apiV2ProgramPoliciesRemainingslotsGet($term_id, $prog_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->apiV2ProgramPoliciesRemainingslotsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | [optional] |
| **prog_id** | **int**|  | [optional] |

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

## `getPolicy()`

```php
getPolicy($prog_policy_id)
```

Get a policy by Id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ProgramPoliciesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$prog_policy_id = 56; // int | 

try {
    $apiInstance->getPolicy($prog_policy_id);
} catch (Exception $e) {
    echo 'Exception when calling ProgramPoliciesApi->getPolicy: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **prog_policy_id** | **int**|  | |

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
