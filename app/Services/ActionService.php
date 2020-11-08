<?php

namespace App\Services;

use App\Models\Action;
use App\Repositories\Action\ActionRepositoryInterface;

class ActionService
{
    /**
     * @var ActionRepositoryInterface
     */
    protected $actionRepo;

    /**
     * @param ActionRepositoryInterface $customerRepo
     */
    public function __construct(ActionRepositoryInterface $actionRepo)
    {
        $this->actionRepo = $actionRepo;
    }

    /**
     * @param array $data
     * 
     * @return Action
     */
    public function create(array $data): Action
    {
        return $this->actionRepo->create($data);
    }

    /**
     * @param array $filters
     * @param int $perPage
     * 
     * @return [type]
     */
    public function getAll(array $filters, int $perPage = 0)
    {
        return $this->actionRepo->getAll($filters, $perPage);
    }

    /**
     * @return array
     */
    public function getActionTypes(): array
    {
        return config('constants.actionTypes');
    }
}
