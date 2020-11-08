<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Services\CustomerService;
use App\Services\UserService;

class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->getAll(['keyword' => request('keyword')], $perPage = 10);
        if (request()->ajax()) {
            return view('customers.table', compact('customers'))->render();
        }
        return view('customers.index', compact('customers'));
    }

    public function create(UserService $userService)
    {
        $employees = $userService->getAll(['roles' => ['employee']]);
        return view('customers.create', compact('employees'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->customerService->create($request->validated());
            return redirect()->route('customers.index')->withMessage('Customer Created Successfully');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }

    public function edit($id, UserService $userService)
    {
        $employees = $userService->getAll(['roles' => ['employee']]);
        $customer = $this->customerService->getSingleBy(['id' => $id]);
        return view('customers.edit', compact('employees', 'customer'));
    }

    public function update($id, UpdateRequest $request)
    {
        try {
            $customer = $this->customerService->getSingleBy(['id' => $id]);
            $this->customerService->update($customer, $request->validated());
            return redirect()->route('customers.index')->withMessage('Customer Updated Successfully');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }
}
