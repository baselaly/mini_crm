<?php

namespace App\Services;

class AuthService
{
    /**
     * @param array $credentials
     * 
     * @return bool
     */
    public function login(array $credentials): bool
    {
        return auth()->attempt($credentials);
    }

    public function logout()
    {
        return auth()->logout();
    }
}
