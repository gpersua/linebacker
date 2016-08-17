<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => linebacker\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '1576713045973208'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', 'b1fc27a574e70420607a93c713154dd6'),
        'redirect' => env('URL', 'http://localhost:54217/').'facebook/login',
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '550110295159-8dsvgsh3c6agm19dqa5e9t9ss5i791ls.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', 'Pcw88cHcoc7aQZwqvXZT2kWL'),
        'redirect' => env('URL', 'http://localhost:54217/').'google/login',
    ],

];
