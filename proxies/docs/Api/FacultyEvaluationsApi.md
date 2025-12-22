# OpenAPI\Client\FacultyEvaluationsApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet()**](FacultyEvaluationsApi.md#apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet) | **GET** /api/v2/FacultyEvaluations/campus/{campusId}/term/{termId}/student/{studentNo} |  |


## `apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet()`

```php
apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet($campus_id, $term_id, $student_no)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\FacultyEvaluationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$campus_id = 56; // int
$term_id = 56; // int
$student_no = 'student_no_example'; // string

try {
    $apiInstance->apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet($campus_id, $term_id, $student_no);
} catch (Exception $e) {
    echo 'Exception when calling FacultyEvaluationsApi->apiV2FacultyEvaluationsCampusCampusIdTermTermIdStudentStudentNoGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **campus_id** | **int**|  | |
| **term_id** | **int**|  | |
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
