<?php

namespace App\Http\Controllers;

use App\Http\Requests\Action\StoreRequest;
use App\Services\ActionService;
use App\Services\CustomerService;

class ActionController extends Controller
{
    /**
     * @var ActionService
     */
    protected $actionService;

    /**
     * @param ActionService $actionService
     */
    public function __construct(ActionService $actionService)
    {
        $this->actionService = $actionService;
    }

    public function getCustomerActions($customerId, CustomerService $customerService)
    {
        $customerFilters = ['id' => $customerId];
        if (auth()->user()->hasRole('employee')) {
            $customerFilters['employee_id'] = auth()->id();
        }
        // to make sure that authenticated user is authorized to see that actions
        $customer = $customerService->getSingleBy($customerFilters);
        $actions = $this->actionService->getAll(['customer_id' => $customerId, 'keyword' => request('keyword')], $perPage = 10);
        if (request()->ajax()) {
            return view('actions.table', compact('actions'))->render();
        }
        return view('actions.index', compact('customer', 'actions'));
    }

    public function create($customerId, CustomerService $customerService)
    {
        $customerFilters = ['id' => $customerId];
        if (auth()->user()->hasRole('employee')) {
            $customerFilters['employee_id'] = auth()->id();
        }
        // to make sure that authenticated user is authorized to see that user actions
        $customer = $customerService->getSingleBy($customerFilters);
        $types = $this->actionService->getActionTypes();
        return view('actions.create', compact('customer', 'types'));
    }

    public function store($customerId, StoreRequest $request, CustomerService $customerService)
    {
        try {
            $customerFilters = ['id' => $customerId];
            if (auth()->user()->hasRole('employee')) {
                $customerFilters['employee_id'] = auth()->id();
            }
            // to make sure that authenticated user is authorized to see that user actions
            $customer = $customerService->getSingleBy($customerFilters);
            $this->actionService->create(array_merge($request->validated(), ['customer_id' => $customer->id]));
            return redirect()->route('customers.action', $customer->id);
        } catch (\Throwable $t) {
            return $t->getMessage();
        }
    }
}
