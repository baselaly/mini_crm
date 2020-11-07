<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll(['keyword' => request('keyword')]);
        if (request()->ajax()) {
            return view('users.table', compact('users'))->render();
        }
        return view('users.index', compact('users'));
    }
}
