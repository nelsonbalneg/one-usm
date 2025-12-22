<?php

namespace App\Services;

use OpenAPI\Client\Api\ProgramPoliciesApi;
use OpenAPI\Client\ApiException;

class ApiProgramPoliciesService
{
    protected $client;

    public function __construct()
    {
        // Initialize the ProgramPoliciesApi client
        $this->client = new ProgramPoliciesApi();
    }

    public function getProgramPolicies($termId, $realCampusId, $contentType = 'application/json')
    {
        try {
            $result = $this->client->apiV2ProgramPoliciesListTermTermIdRealcampusRealCampusIdGet($termId, $realCampusId, $contentType);
            return $result;
        } catch (ApiException $e) {
            // Handle exceptions or log errors
            throw new \Exception("API Request failed: " . $e->getMessage());
        }
    }
}
