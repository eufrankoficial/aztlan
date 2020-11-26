<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    function authenticate(array $credentials, bool $rememberToken): bool
    {
        $authenticad = Auth::attempt($credentials, $rememberToken);
        return $authenticad;
    }

    function logout(): void
    {
        Auth::logout();
    }
}
