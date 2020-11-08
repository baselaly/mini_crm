<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\Customer\CustomerRepositoryInterface;

class CustomerService
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepo;

    /**
     * @param CustomerRepositoryInterface $customerRepo
     */
    public function __construct(CustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    /**
     * @param array $filters
     * @param int $perPage
     * 
     * @return [type]
     */
    public function getAll(array $filters, int $perPage = 10)
    {
        return $this->customerRepo->getAll($filters, $perPage);
    }

    /**
     * @param array $filters
     * 
     * @return Customer
     */
    public function getSingleBy(array $filters): Customer
    {
        return $this->customerRepo->getSingleBy($filters);
    }

    /**
     * @param array $data
     * 
     * @return Customer
     */
    public function create(array $data): Customer
    {
        return $this->customerRepo->create($data);
    }

    /**
     * @param Customer $customer
     * @param array $data
     * 
     * @return Customer
     */
    public function update(Customer $customer, array $data): Customer
    {
        $this->customerRepo->update($customer, $data);
        $customer->refresh();
        return $customer;
    }
}
