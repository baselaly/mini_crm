<?php

namespace App\Services;

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
    public function getAll(array $filters = [], int $perPage = 10)
    {
        return $this->userRepo->getAll($filters, $perPage);
    }
}
