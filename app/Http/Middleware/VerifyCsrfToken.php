<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
       "/vigenesia/api/login",
       "/vigenesia/api/registrasi",
       '/vigenesia/api/Get_motivasi*',
       '/vigenesia/api/dev/PUTmotivasi',
       '/vigenesia/api/dev/POSTmotivasi',
       '/vigenesia/api/dev/DELETEmotivasi',
    ];
}
