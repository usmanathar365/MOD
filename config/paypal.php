<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),

    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', 'AduZBKCS0SYrrqmzbymfiUfB2I_-83KvsrKrG38ZtM1t_jdnDPuKDHNbb9aLLVqNFkM6EZlJbzpK2FFN'),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', 'EBBBPGlbkBgbJzsJr6FGyMiCMZ-K7bDlqpAroC5p1HN2Jwc9DLWgV2nw-JUIzNpPAaujbZcuM2ZR8AD1'),
        'app_id'            => 'APP-80W284485P519543T',
    ],

    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''),
    'locale'         => env('PAYPAL_LOCALE', 'en_US'),
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
];