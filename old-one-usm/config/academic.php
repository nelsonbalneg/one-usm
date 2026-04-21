<?php

return [

    'base_url' => env('ACADEMIC_API_URL', 'http://default-ip-if-needed'),
    // FPES API base URL (for token generation)
    'fpes_api_url' => env('ACADEMIC_FPES_API_URL', 'http://172.16.0.41/api/app/'),

    'sar_api_url' => env('SAR_API_URL', 'http://default-sar-url'),
    'sar_redirect_url' => env('SAR_REDIRECT_URL', 'https://sar.usm.edu.ph/verify/?id='),
    'sar_tenant_id' => env('SAR_TENANT_ID', 1),
    'sar_campus_id' => env('SAR_CAMPUS_ID', 1),

    'ccd_redirect_url' => env('CCD_REDIRECT_URL', 'https://ccd.usm.edu.ph/verify/?id='),
    'ccd_tenant_id' => env('CCD_TENANT_ID', 1),
    'ccd_campus_id' => env('CCD_CAMPUS_ID', 1),
];
