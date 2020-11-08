<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;

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
        $customers = $this->customerService->getAll(['keyword' => request('keyword')]);
        if (request()->ajax()) {
            return view('customers.table', compact('customers'))->render();
        }
        return view('customers.index', compact('customers'));
    }
}
