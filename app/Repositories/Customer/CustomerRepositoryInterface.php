<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

interface CustomerRepositoryInterface
{
    /**
     * @param array $data
     * 
     * @return [type]
     */
    public function getAll(array $data = [], int $perPage = 0);

    /**
     * @param array $data
     * 
     * @return Customer
     */
    public function getSingleBy(array $data = []): Customer;

    /**
     * @param array $data
     * 
     * @return Customer
     */
    public function create(array $data): Customer;

    /**
     * @param Customer $customer
     * @param array $data
     * 
     * @return bool
     */
    public function update(Customer $customer, array $data): bool;
}
