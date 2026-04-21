# OpenAPI\Client\StudentsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2StudentsAddStudentToPortalPost()**](StudentsApi.md#apiV2StudentsAddStudentToPortalPost) | **POST** /api/v2/Students/AddStudentToPortal |  |
| [**apiV2StudentsAdmitStudentNoValidationPost()**](StudentsApi.md#apiV2StudentsAdmitStudentNoValidationPost) | **POST** /api/v2/Students/admit-student/no-validation | Approve student from econ. Validates if there are still slots |
| [**apiV2StudentsAdmitStudentPost()**](StudentsApi.md#apiV2StudentsAdmitStudentPost) | **POST** /api/v2/Students/admit-student | Approve student from econ. Validates if there are still slots |
| [**apiV2StudentsCampusCampusIdGetbyemailEmailGet()**](StudentsApi.md#apiV2StudentsCampusCampusIdGetbyemailEmailGet) | **GET** /api/v2/Students/campus/{campusId}/getbyemail/{email} |  |
| [**apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet()**](StudentsApi.md#apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet) | **GET** /api/v2/Students/campus/{campusId}/getbyemail/{email}/term/{termId} |  |
| [**apiV2StudentsFilteredbystatusGet()**](StudentsApi.md#apiV2StudentsFilteredbystatusGet) | **GET** /api/v2/Students/filteredbystatus |  |
| [**apiV2StudentsGeneratenewidGet()**](StudentsApi.md#apiV2StudentsGeneratenewidGet) | **GET** /api/v2/Students/generatenewid |  |
| [**apiV2StudentsGetemailpasswordGet()**](StudentsApi.md#apiV2StudentsGetemailpasswordGet) | **GET** /api/v2/Students/getemailpassword |  |
| [**apiV2StudentsGetstudentidGet()**](StudentsApi.md#apiV2StudentsGetstudentidGet) | **GET** /api/v2/Students/getstudentid | Searches all tenant DBs if the student exists |
| [**apiV2StudentsMismatchedGet()**](StudentsApi.md#apiV2StudentsMismatchedGet) | **GET** /api/v2/Students/mismatched |  |
| [**apiV2StudentsNoValidationPost()**](StudentsApi.md#apiV2StudentsNoValidationPost) | **POST** /api/v2/Students/no-validation |  |
| [**apiV2StudentsPost()**](StudentsApi.md#apiV2StudentsPost) | **POST** /api/v2/Students |  |
| [**apiV2StudentsPreregStatuscountStatusPolicyIdGet()**](StudentsApi.md#apiV2StudentsPreregStatuscountStatusPolicyIdGet) | **GET** /api/v2/Students/prereg/statuscount/{status}/{policyId} |  |
| [**apiV2StudentsRequestemailupdatePut()**](StudentsApi.md#apiV2StudentsRequestemailupdatePut) | **PUT** /api/v2/Students/requestemailupdate |  |
| [**apiV2StudentsStudentIdDatacompletenessGet()**](StudentsApi.md#apiV2StudentsStudentIdDatacompletenessGet) | **GET** /api/v2/Students/{studentId}/datacompleteness |  |
| [**apiV2StudentsStudentIdPut()**](StudentsApi.md#apiV2StudentsStudentIdPut) | **PUT** /api/v2/Students/{studentId} |  |
| [**apiV2StudentsValidateregistrationGet()**](StudentsApi.md#apiV2StudentsValidateregistrationGet) | **GET** /api/v2/Students/validateregistration |  |
| [**apiV2StudentsVerifyineslocalGet()**](StudentsApi.md#apiV2StudentsVerifyineslocalGet) | **GET** /api/v2/Students/verifyineslocal |  |
| [**apiV2StudentsWithauthPost()**](StudentsApi.md#apiV2StudentsWithauthPost) | **POST** /api/v2/Students/withauth |  |
| [**getStudent()**](StudentsApi.md#getStudent) | **GET** /api/v2/Students/{id} |  |
| [**getStudentByIdAndTenant()**](StudentsApi.md#getStudentByIdAndTenant) | **GET** /api/v2/Students/{id}/tenant |  |


## `apiV2StudentsAddStudentToPortalPost()`

```php
apiV2StudentsAddStudentToPortalPost($tenant_id, $student_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_dto = new \OpenAPI\Client\Model\StudentDto(); // \OpenAPI\Client\Model\StudentDto

try {
    $apiInstance->apiV2StudentsAddStudentToPortalPost($tenant_id, $student_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsAddStudentToPortalPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_dto** | [**\OpenAPI\Client\Model\StudentDto**](../Model/StudentDto.md)|  | [optional] |

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

## `apiV2StudentsAdmitStudentNoValidationPost()`

```php
apiV2StudentsAdmitStudentNoValidationPost($tenant_id, $approve_applicant_dto)
```

Approve student from econ. Validates if there are still slots

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$approve_applicant_dto = new \OpenAPI\Client\Model\ApproveApplicantDto(); // \OpenAPI\Client\Model\ApproveApplicantDto | 

try {
    $apiInstance->apiV2StudentsAdmitStudentNoValidationPost($tenant_id, $approve_applicant_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsAdmitStudentNoValidationPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **approve_applicant_dto** | [**\OpenAPI\Client\Model\ApproveApplicantDto**](../Model/ApproveApplicantDto.md)|  | [optional] |

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

## `apiV2StudentsAdmitStudentPost()`

```php
apiV2StudentsAdmitStudentPost($tenant_id, $approve_applicant_dto)
```

Approve student from econ. Validates if there are still slots

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs | 
$approve_applicant_dto = new \OpenAPI\Client\Model\ApproveApplicantDto(); // \OpenAPI\Client\Model\ApproveApplicantDto | 

try {
    $apiInstance->apiV2StudentsAdmitStudentPost($tenant_id, $approve_applicant_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsAdmitStudentPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **approve_applicant_dto** | [**\OpenAPI\Client\Model\ApproveApplicantDto**](../Model/ApproveApplicantDto.md)|  | [optional] |

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

## `apiV2StudentsCampusCampusIdGetbyemailEmailGet()`

```php
apiV2StudentsCampusCampusIdGetbyemailEmailGet($email, $campus_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$email = 'email_example'; // string
$campus_id = 'campus_id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2StudentsCampusCampusIdGetbyemailEmailGet($email, $campus_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsCampusCampusIdGetbyemailEmailGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **email** | **string**|  | |
| **campus_id** | **string**|  | |
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

## `apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet()`

```php
apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet($email, $term_id, $campus_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$email = 'email_example'; // string
$term_id = 56; // int
$campus_id = 'campus_id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet($email, $term_id, $campus_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsCampusCampusIdGetbyemailEmailTermTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **email** | **string**|  | |
| **term_id** | **int**|  | |
| **campus_id** | **string**|  | |
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

## `apiV2StudentsFilteredbystatusGet()`

```php
apiV2StudentsFilteredbystatusGet($campus_id, $college_id, $program_id, $status, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$college_id = 56; // int
$program_id = 56; // int
$status = 'status_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2StudentsFilteredbystatusGet($campus_id, $college_id, $program_id, $status, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsFilteredbystatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | [optional] |
| **college_id** | **int**|  | [optional] |
| **program_id** | **int**|  | [optional] |
| **status** | **string**|  | [optional] |
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

## `apiV2StudentsGeneratenewidGet()`

```php
apiV2StudentsGeneratenewidGet()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2StudentsGeneratenewidGet();
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsGeneratenewidGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2StudentsGetemailpasswordGet()`

```php
apiV2StudentsGetemailpasswordGet($campus_id, $term_id, $student_no, $last_name, $first_name, $cor_number, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$term_id = 56; // int
$student_no = 'student_no_example'; // string
$last_name = 'last_name_example'; // string
$first_name = 'first_name_example'; // string
$cor_number = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2StudentsGetemailpasswordGet($campus_id, $term_id, $student_no, $last_name, $first_name, $cor_number, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsGetemailpasswordGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | [optional] |
| **term_id** | **int**|  | [optional] |
| **student_no** | **string**|  | [optional] |
| **last_name** | **string**|  | [optional] |
| **first_name** | **string**|  | [optional] |
| **cor_number** | **int**|  | [optional] |
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

## `apiV2StudentsGetstudentidGet()`

```php
apiV2StudentsGetstudentidGet($last_name, $firstname, $middle_name)
```

Searches all tenant DBs if the student exists

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$last_name = 'last_name_example'; // string
$firstname = 'firstname_example'; // string
$middle_name = 'middle_name_example'; // string

try {
    $apiInstance->apiV2StudentsGetstudentidGet($last_name, $firstname, $middle_name);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsGetstudentidGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **last_name** | **string**|  | [optional] |
| **firstname** | **string**|  | [optional] |
| **middle_name** | **string**|  | [optional] |

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

## `apiV2StudentsMismatchedGet()`

```php
apiV2StudentsMismatchedGet()
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->apiV2StudentsMismatchedGet();
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsMismatchedGet: ', $e->getMessage(), PHP_EOL;
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

## `apiV2StudentsNoValidationPost()`

```php
apiV2StudentsNoValidationPost($tenant_id, $student_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_dto = new \OpenAPI\Client\Model\StudentDto(); // \OpenAPI\Client\Model\StudentDto

try {
    $apiInstance->apiV2StudentsNoValidationPost($tenant_id, $student_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsNoValidationPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_dto** | [**\OpenAPI\Client\Model\StudentDto**](../Model/StudentDto.md)|  | [optional] |

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

## `apiV2StudentsPost()`

```php
apiV2StudentsPost($tenant_id, $student_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_dto = new \OpenAPI\Client\Model\StudentDto(); // \OpenAPI\Client\Model\StudentDto

try {
    $apiInstance->apiV2StudentsPost($tenant_id, $student_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_dto** | [**\OpenAPI\Client\Model\StudentDto**](../Model/StudentDto.md)|  | [optional] |

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

## `apiV2StudentsPreregStatuscountStatusPolicyIdGet()`

```php
apiV2StudentsPreregStatuscountStatusPolicyIdGet($status, $policy_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$status = 'status_example'; // string
$policy_id = 56; // int

try {
    $apiInstance->apiV2StudentsPreregStatuscountStatusPolicyIdGet($status, $policy_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsPreregStatuscountStatusPolicyIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **status** | **string**|  | |
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

## `apiV2StudentsRequestemailupdatePut()`

```php
apiV2StudentsRequestemailupdatePut($tenant_id, $request_student_validation_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$request_student_validation_dto = new \OpenAPI\Client\Model\RequestStudentValidationDto(); // \OpenAPI\Client\Model\RequestStudentValidationDto

try {
    $apiInstance->apiV2StudentsRequestemailupdatePut($tenant_id, $request_student_validation_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsRequestemailupdatePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **request_student_validation_dto** | [**\OpenAPI\Client\Model\RequestStudentValidationDto**](../Model/RequestStudentValidationDto.md)|  | [optional] |

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

## `apiV2StudentsStudentIdDatacompletenessGet()`

```php
apiV2StudentsStudentIdDatacompletenessGet($student_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2StudentsStudentIdDatacompletenessGet($student_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsStudentIdDatacompletenessGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
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

## `apiV2StudentsStudentIdPut()`

```php
apiV2StudentsStudentIdPut($student_id, $campus_id, $tenant_id, $student_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_id = 'student_id_example'; // string
$campus_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_dto = new \OpenAPI\Client\Model\StudentDto(); // \OpenAPI\Client\Model\StudentDto

try {
    $apiInstance->apiV2StudentsStudentIdPut($student_id, $campus_id, $tenant_id, $student_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsStudentIdPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_id** | **string**|  | |
| **campus_id** | **int**|  | [optional] |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_dto** | [**\OpenAPI\Client\Model\StudentDto**](../Model/StudentDto.md)|  | [optional] |

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

## `apiV2StudentsValidateregistrationGet()`

```php
apiV2StudentsValidateregistrationGet($firstname, $lastname, $student_no, $term_id, $campus_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$firstname = 'firstname_example'; // string
$lastname = 'lastname_example'; // string
$student_no = 'student_no_example'; // string
$term_id = 56; // int
$campus_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2StudentsValidateregistrationGet($firstname, $lastname, $student_no, $term_id, $campus_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsValidateregistrationGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **firstname** | **string**|  | [optional] |
| **lastname** | **string**|  | [optional] |
| **student_no** | **string**|  | [optional] |
| **term_id** | **int**|  | [optional] |
| **campus_id** | **int**|  | [optional] |
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

## `apiV2StudentsVerifyineslocalGet()`

```php
apiV2StudentsVerifyineslocalGet($last_name, $firstname, $middle_name)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$last_name = 'last_name_example'; // string
$firstname = 'firstname_example'; // string
$middle_name = 'middle_name_example'; // string

try {
    $apiInstance->apiV2StudentsVerifyineslocalGet($last_name, $firstname, $middle_name);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsVerifyineslocalGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **last_name** | **string**|  | [optional] |
| **firstname** | **string**|  | [optional] |
| **middle_name** | **string**|  | [optional] |

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

## `apiV2StudentsWithauthPost()`

```php
apiV2StudentsWithauthPost($tenant_id, $student_dto)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs
$student_dto = new \OpenAPI\Client\Model\StudentDto(); // \OpenAPI\Client\Model\StudentDto

try {
    $apiInstance->apiV2StudentsWithauthPost($tenant_id, $student_dto);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->apiV2StudentsWithauthPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |
| **student_dto** | [**\OpenAPI\Client\Model\StudentDto**](../Model/StudentDto.md)|  | [optional] |

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

## `getStudent()`

```php
getStudent($id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->getStudent($id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->getStudent: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
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

## `getStudentByIdAndTenant()`

```php
getStudentByIdAndTenant($id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\StudentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->getStudentByIdAndTenant($id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling StudentsApi->getStudentByIdAndTenant: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**|  | |
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
