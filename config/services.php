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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // WhatsApp Cloud API (admin > WhatsApp) and the Meta app "Dikerjain".
    'whatsapp' => [
        'graph_version' => env('WA_GRAPH_VERSION', 'v27.0'),
        // System User token with business_management,
        // whatsapp_business_management and whatsapp_business_messaging.
        'access_token' => env('WA_ACCESS_TOKEN', ''),
        'business_id' => env('WA_BUSINESS_ID', ''),
        'waba_id' => env('WA_WABA_ID', ''),
        'phone_number_id' => env('WA_PHONE_NUMBER_ID', ''),
        // Embedded Signup (Coexistence) and the webhook signature.
        'app_id' => env('META_APP_ID', ''),
        'app_secret' => env('META_APP_SECRET', ''),
        'es_config_id' => env('WA_ES_CONFIG_ID', ''),
        'webhook_verify_token' => env('WA_WEBHOOK_VERIFY_TOKEN', ''),
    ],

];
