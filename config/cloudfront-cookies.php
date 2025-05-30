<?php

declare(strict_types=1);

return [
    'version' => env('CLOUDFRONT_VERSION', 'latest'),

    'region' => env('CLOUDFRONT_REGION', 'us-east-1'),

    'key_pair_id' => env('CLOUDFRONT_KEY_PAIR_ID', ''),

    'private_key_path' => env('CLOUDFRONT_PRIVATE_KEY_PATH', ''),

    'private_key_storage' => env('CLOUDFRONT_PRIVATE_KEY_STORAGE', 'local'),

    'resource' => env('CLOUDFRONT_RESOURCE', 'http*://localhost/*'),

    'cookies_expiration' => [
        'unit' => \Carbon\CarbonInterval::PERIOD_DAYS,
        'value' => 2,
    ],

    'cookies_domain' => env('CLOUDFRONT_COOKIES_DOMAIN'),
];
