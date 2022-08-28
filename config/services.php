<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'google' => [
        'client_id' => '899017914763-mirupli0fpn84djnsdgu6cti5ajeeho0.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://darmah.mas-adi.net/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '756218619045831', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '7114aae117b0f0156229836fd16c91e6', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://darmah.mas-adi.net/auth/facebook/callback'
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
