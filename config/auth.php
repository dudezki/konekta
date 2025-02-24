<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'merchants', // Change this to match the correct provider
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you define every authentication guard for your application.
    | A default configuration has been set for you using session storage.
    |
    */

    'guards' => [
        'merchant' => [
            'driver' => 'session',
            'provider' => 'merchants',
        ],

        'web' => [
            'driver' => 'session',
            'provider' => 'merchants', // Ensure this points to merchants
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Each authentication guard has a user provider, which defines how the
    | users are retrieved from your database or storage system.
    |
    */

    'providers' => [
        'merchants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Merchant::class, // Ensure this is correct
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These settings specify how Laravel's password reset system should work.
    |
    */

    'passwords' => [
        'merchants' => [
            'provider' => 'merchants',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Defines how long (in seconds) before users must re-enter their password.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
