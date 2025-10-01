<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Team Kinetic API Base URL
    |--------------------------------------------------------------------------
    */
    'base_url' => env('KINETIC_API_BASE_URL', 'https://tk-api.teamkinetic.co.uk'),

    /*
    |--------------------------------------------------------------------------
    | Team Kinetic API Secret
    |--------------------------------------------------------------------------
    |
    | Enter your Team Kinetic API secret here. This is used to authenticate
    |
    */
    'api_secret' => env('KINETIC_API_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | API Request Timeout
    |--------------------------------------------------------------------------
    |
    | Set the maximum number of seconds to wait for a response
    |
    */
    'timeout' => env('KINETIC_API_TIMEOUT', 30),
];
