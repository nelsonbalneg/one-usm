# OpenAPI\Client\SarAdmissionReqsTaggingsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2SarSarAdmissionReqsTaggingsPost()**](SarAdmissionReqsTaggingsApi.md#apiV2SarSarAdmissionReqsTaggingsPost) | **POST** /api/v2/sar/SarAdmissionReqsTaggings | Create a new Admission Requirement checklist for a student |
| [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut()**](SarAdmissionReqsTaggingsApi.md#apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/cert-of-grad | Update a student&#39;s HS certificate of graduation submission status |
| [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut()**](SarAdmissionReqsTaggingsApi.md#apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/form137a | Update a student&#39;s Form 137a submission status |
| [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put()**](SarAdmissionReqsTaggingsApi.md#apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/tag-form138 | Update a student&#39;s Form 138 submission status |
| [**apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut()**](SarAdmissionReqsTaggingsApi.md#apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut) | **PUT** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/{campusId}/tag-psa | Update a student&#39;s PSA Birth Certificate submission status |
| [**getAdmissionRequirement()**](SarAdmissionReqsTaggingsApi.md#getAdmissionRequirement) | **GET** /api/v2/sar/SarAdmissionReqsTaggings/{studentNo}/campus/{campusId} |  |


## `apiV2SarSarAdmissionReqsTaggingsPost()`

```php
apiV2SarSarAdmissionReqsTaggingsPost($admission_requirement_dto)
```

Create a new Admission Requirement checklist for a student

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarAdmissionReqsTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$admission_requirement_dto = new \OpenAPI\Client\Model\AdmissionRequirementDto(); // \OpenAPI\Client\Model\AdmissionRequirementDto | 

try {
    $apiInstance->apiV2SarSarAdmissionReqsTaggingsPost($admission_requirement_dto);
} catch (Exception $e) {
    echo 'Exception when calling SarAdmissionReqsTaggingsApi->apiV2SarSarAdmissionReqsTaggingsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **admission_requirement_dto** | [**\OpenAPI\Client\Model\AdmissionRequirementDto**](../Model/AdmissionRequirementDto.md)|  | [optional] |

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

## `apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut()`

```php
apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut($student_no, $campus_id, $tag_cert_of_grad_input)
```

Update a student's HS certificate of graduation submission status

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarAdmissionReqsTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$campus_id = 56; // int | 
$tag_cert_of_grad_input = new \OpenAPI\Client\Model\TagCertOfGradInput(); // \OpenAPI\Client\Model\TagCertOfGradInput | 

try {
    $apiInstance->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut($student_no, $campus_id, $tag_cert_of_grad_input);
} catch (Exception $e) {
    echo 'Exception when calling SarAdmissionReqsTaggingsApi->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdCertOfGradPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **campus_id** | **int**|  | |
| **tag_cert_of_grad_input** | [**\OpenAPI\Client\Model\TagCertOfGradInput**](../Model/TagCertOfGradInput.md)|  | [optional] |

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

## `apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut()`

```php
apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut($student_no, $campus_id, $tag_from137a_input)
```

Update a student's Form 137a submission status

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarAdmissionReqsTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$campus_id = 56; // int | 
$tag_from137a_input = new \OpenAPI\Client\Model\TagFrom137aInput(); // \OpenAPI\Client\Model\TagFrom137aInput | 

try {
    $apiInstance->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut($student_no, $campus_id, $tag_from137a_input);
} catch (Exception $e) {
    echo 'Exception when calling SarAdmissionReqsTaggingsApi->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdForm137aPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **campus_id** | **int**|  | |
| **tag_from137a_input** | [**\OpenAPI\Client\Model\TagFrom137aInput**](../Model/TagFrom137aInput.md)|  | [optional] |

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

## `apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put()`

```php
apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put($student_no, $campus_id, $tag_form138_input)
```

Update a student's Form 138 submission status

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarAdmissionReqsTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$campus_id = 56; // int | 
$tag_form138_input = new \OpenAPI\Client\Model\TagForm138Input(); // \OpenAPI\Client\Model\TagForm138Input | 

try {
    $apiInstance->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put($student_no, $campus_id, $tag_form138_input);
} catch (Exception $e) {
    echo 'Exception when calling SarAdmissionReqsTaggingsApi->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagForm138Put: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **campus_id** | **int**|  | |
| **tag_form138_input** | [**\OpenAPI\Client\Model\TagForm138Input**](../Model/TagForm138Input.md)|  | [optional] |

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

## `apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut()`

```php
apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut($student_no, $campus_id, $tag_psa_input)
```

Update a student's PSA Birth Certificate submission status

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarAdmissionReqsTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string | 
$campus_id = 56; // int | 
$tag_psa_input = new \OpenAPI\Client\Model\TagPsaInput(); // \OpenAPI\Client\Model\TagPsaInput | 

try {
    $apiInstance->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut($student_no, $campus_id, $tag_psa_input);
} catch (Exception $e) {
    echo 'Exception when calling SarAdmissionReqsTaggingsApi->apiV2SarSarAdmissionReqsTaggingsStudentNoCampusIdTagPsaPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **campus_id** | **int**|  | |
| **tag_psa_input** | [**\OpenAPI\Client\Model\TagPsaInput**](../Model/TagPsaInput.md)|  | [optional] |

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

## `getAdmissionRequirement()`

```php
getAdmissionRequirement($student_no, $campus_id, $tenant_id): \OpenAPI\Client\Model\AdmissionRequirementDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SarAdmissionReqsTaggingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$student_no = 'student_no_example'; // string
$campus_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $result = $apiInstance->getAdmissionRequirement($student_no, $campus_id, $tenant_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SarAdmissionReqsTaggingsApi->getAdmissionRequirement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **student_no** | **string**|  | |
| **campus_id** | **int**|  | |
| **tenant_id** | [**\OpenAPI\Client\Model\TenantDbs**](../Model/.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\AdmissionRequirementDto**](../Model/AdmissionRequirementDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `text/plain; x-api-version=2.0`, `application/json; x-api-version=2.0`, `text/json; x-api-version=2.0`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
