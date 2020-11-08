<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;

    /**
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param array $filters
     * @param int $perPage
     * 
     * @return [type]
     */
    public function getAll(array $filters = [], int $perPage = 0)
    {
        return $this->userRepo->getAll($filters, $perPage);
    }

    /**
     * @param array $data
     * 
     * @return User
     */
    public function create(array $data): User
    {
        $user = $this->userRepo->create($data);
        $user->assignRole($data['role']);
        return $user;
    }

    /**
     * @param array $data
     * 
     * @return User
     */
    public function getSingleBy(array $data = []): User
    {
        return $this->userRepo->getSingleBy($data);
    }

    /**
     * @param User $user
     * @param array $data
     * 
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $this->userRepo->update($user, $data);
        $user->refresh();
        return $user;
    }
}
