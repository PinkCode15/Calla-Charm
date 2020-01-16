<?php

return [

    /**
     * Diamond bank api credentials
     */
    'diamond_bank' => [
        'client_id' => env('DIAMOND_CLIENT_ID'),
        'client_secret' => env('DIAMOND_CLIENT_SECRET'),
        'payment_url' => env('DIAMOND_PAYMENT_URL'),
        'authorization_url' => env('DIAMOND_AUTHORIZATION_URL'),
    ],

    /**
     * Flutterwave api credentials
     */
    'charge' => [
        'deposit' => env('CHARGE_DEPOSIT'),
        'withdraw' => env ('CHARGE_WITHDRAW'),
    ],

    'flutterwave' => [
        'secret_key' => env('FLUTTERWAVE_SECRET_KEY'),
        'public_key' => env('FLUTTERWAVE_PUBLIC_KEY'),
        'root_url' => env('FLUTTERWAVE_API_ROOT_URL'),
    ],

    'paystack' => [
        'secret_key' => env('PAYSTACK_SECRET_KEY'),
        'public_key' => env('PAYSTACK_PUBLIC_KEY'),
        'test_secret_key' => env('PAYSTACK_TEST_SECRET_KEY'),
        'test_public_key' => env('PAYSTACK_TEST_PUBLIC_KEY'),
        'api_url' => env('PAYSTACK_API_URL'),
        'requery_url' => env('PAYSTACK_REQUERY_URL'),
        'transfer_recipient_url' => env('PAYSTACK_TRANSFER_RECIPIENT_URL'),
        'transfer_url' => env('PAYSTACK_TRANSFER_URL'),
        // 'root_url' => env('PAYSTACK_API_ROOT_URL'),
    ],

];




