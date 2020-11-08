<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\RoleService;
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
        $users = $this->userService->getAll(['keyword' => request('keyword')], $perPage = 10);
        if (request()->ajax()) {
            return view('users.table', compact('users'))->render();
        }
        return view('users.index', compact('users'));
    }

    public function create(RoleService $roleService)
    {
        $roles = $roleService->getRoles();
        return view('users.create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->userService->create($request->validated());
            return redirect()->route('users.index')->withMessage('User Created Successfully');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }

    public function edit($id, RoleService $roleService)
    {
        $roles = $roleService->getRoles();
        $user = $this->userService->getSingleBy(['id' => $id]);
        return view('users.edit', compact('roles', 'user'));
    }

    public function update($id, UpdateRequest $request)
    {
        try {
            $user = $this->userService->getSingleBy(['id' => $id]);
            $this->userService->update($user, $request->validated());
            return redirect()->route('users.index')->withMessage('User Updated Successfully');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }
}
