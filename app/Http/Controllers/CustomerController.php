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
        $filters = ['keyword' => request('keyword')];
        !auth()->user()->hasRole('admin') ? $filters['employee_id'] = auth()->id() : '';
        $customers = $this->customerService->getAll($filters, $perPage = 10);
        if (request()->ajax()) {
            return view('customers.table', compact('customers'))->render();
        }
        return view('customers.index', compact('customers'));
    }

    public function create(UserService $userService)
    {
        // if its admin so we need to get employees for dropdown in view
        $employees = auth()->user()->hasRole('admin') ? $userService->getAll(['roles' => ['employee']]) : [];
        return view('customers.create', compact('employees'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            // if no employee id sent in request and pass the validation then its employee so we will inject its id
            !in_array('employee_id', $validatedData) ? $validatedData['employee_id'] = auth()->id() : '';
            $this->customerService->create($validatedData);
            return redirect()->route('customers.index')->withMessage('Customer Created Successfully');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }

    public function edit($id, UserService $userService)
    {
        $employees = [];
        $filters = ['id' => $id];
        // if its admin so we need to get employees for dropdown in view
        if (auth()->user()->hasRole('admin')) {
            $employees =  $userService->getAll(['roles' => ['employee']]);
        }
        if (auth()->user()->hasRole('employee')) {
            $filters['employee_id'] = auth()->id();
        }
        $customer = $this->customerService->getSingleBy($filters);
        return view('customers.edit', compact('employees', 'customer'));
    }

    public function update($id, UpdateRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $filters = ['id' => $id];
            // if no employee id sent in request and pass the validation then its employee so we will inject its id
            if (!in_array('employee_id', $validatedData)) {
                $validatedData['employee_id'] = auth()->id();
                $filters['employee_id'] = auth()->id();
            }
            $customer = $this->customerService->getSingleBy($filters);
            $this->customerService->update($customer, $validatedData);
            return redirect()->route('customers.index')->withMessage('Customer Updated Successfully');
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }
}
