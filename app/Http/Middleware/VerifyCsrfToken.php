<?php

namespace linebacker\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
         'api/login',
         'api/contactsByUser',
         'api/contactsByUser/store',
         'contactsByUser/store/{userAcc}/{first_name}/{last_name}/{email}/{primary_phone}/{second_phone}',
    ];
}
