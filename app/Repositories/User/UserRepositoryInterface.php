<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
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
     * @return User
     */
    public function getSingleBy(array $data = []): User;

    /**
     * @param array $data
     * 
     * @return User
     */
    public function create(array $data): User;

    /**
     * @param User $user
     * @param array $data
     * 
     * @return bool
     */
    public function update(User $user, array $data): bool;
}
