<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserService
{

    public function getLoggedInUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }



}
