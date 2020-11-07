<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getLogin()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!$this->authService->login($request->validated())) {
                return back()->withErrors('Wrong Credentials');
            }
            return redirect()->route('users.index');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }

    public function logout()
    {
        try {
            $this->authService->logout();
            return redirect()->route('login.get');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }
}
