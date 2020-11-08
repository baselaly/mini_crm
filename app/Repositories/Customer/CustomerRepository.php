<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use Illuminate\Pipeline\Pipeline;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param array $data
     * @param int $perPage
     * 
     * @return [type]
     */
    public function getAll(array $data = [], int $perPage = 10)
    {
        return app(Pipeline::class)
            ->send($this->customer->query())
            ->through([])
            ->thenReturn()
            ->latest()->paginate($perPage);
    }

    /**
     * @param array $data
     * 
     * @return Customer
     */
    public function getSingleBy(array $data = []): Customer
    {
        return app(Pipeline::class)
            ->send($this->customer->query())
            ->through([])
            ->thenReturn()
            ->latest()->firstOrFail();
    }

    /**
     * @param array $data
     * 
     * @return Customer
     */
    public function create(array $data): Customer
    {
        return $this->customer->create($data);
    }

    /**
     * @param Customer $customer
     * @param array $data
     * 
     * @return bool
     */
    public function update(Customer $customer, array $data): bool
    {
        return $customer->update($data);
    }
}
