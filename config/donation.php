<?php

return [
    // url to donation terms page
    'terms' => env('DONATION_TERMS'),

    //providers
    'providers' => [
        // provider token for donation (supported by telegram)
        'telegram' => [
            'token' => env('DONATION_PROVIDERS_TELEGRAM_TOKEN'),
            'prices' => [2, 5, 10, 25, 50, 100],
        ],

        // urls to third party providers
        'third_party' => [
            'Github Sponsor' => env('DONATION_PROVIDERS_THIRD_PARTY_GITHUB'),
            'PayPal' => env('DONATION_PROVIDERS_THIRD_PARTY_PAYPAL'),
        ],
    ]
];
