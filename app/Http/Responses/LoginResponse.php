<?php

namespace App\Http\responses;

use Illuminate\Contracts\Support\Responsable;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        
    }
}
