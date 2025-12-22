# OpenAPI\Client\GrantTemplatesApi

All URIs are relative to http://172.16.0.60/academic, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet()**](GrantTemplatesApi.md#apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet) | **GET** /api/v2/GrantTemplates/by-scho-provider-id-and-term-id/{schoproviderId}/{termId} |  |


## `apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet()`

```php
apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet($term_id, $schoprovider_id, $tenant_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\GrantTemplatesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$term_id = 56; // int
$schoprovider_id = 56; // int
$tenant_id = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\TenantDbs(); // \OpenAPI\Client\Model\TenantDbs

try {
    $apiInstance->apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet($term_id, $schoprovider_id, $tenant_id);
} catch (Exception $e) {
    echo 'Exception when calling GrantTemplatesApi->apiV2GrantTemplatesBySchoProviderIdAndTermIdSchoproviderIdTermIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **term_id** | **int**|  | |
| **schoprovider_id** | **int**|  | |
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
