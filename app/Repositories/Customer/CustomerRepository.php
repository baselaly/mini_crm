<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\QueryFilters\Customer\IdFilter;
use App\QueryFilters\Customer\KeywordFilter;
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
    public function getAll(array $data = [], int $perPage = 0)
    {
        $customers = app(Pipeline::class)
            ->send($this->customer->query())
            ->through([
                new IdFilter($data),
                new KeywordFilter($data)
            ])
            ->thenReturn()
            ->latest();

        return $perPage ? $customers->paginate($perPage) : $customers->get();
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
            ->through([
                new IdFilter($data),
                new KeywordFilter($data)
            ])
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
