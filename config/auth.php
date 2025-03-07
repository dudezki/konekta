<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Defines the default authentication "guard" and password reset "broker".
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'users',
        'login' => 'user_login' 
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you define every authentication guard for your application.
    |
    */

    'guards' => [
        'web' => [ // For Users
            'driver' => 'session',
            'provider' => 'users', // Change this to 'users'
        ],

        'merchant' => [ // For Merchants
            'driver' => 'session',
            'provider' => 'merchants',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | User providers define how users are retrieved from the database.
    |
    */

    'providers' => [
        'users' => [ // Add this for Users
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Ensure this is correct
        ],

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
    | These settings define how Laravel handles password resets.
    |
    */

    'passwords' => [
        'users' => [ // Add password reset settings for Users
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

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
