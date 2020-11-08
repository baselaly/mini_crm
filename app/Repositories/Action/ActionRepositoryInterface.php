<?php

namespace App\Repositories\Action;

use App\Models\Action;

interface ActionRepositoryInterface
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
     * @return Action
     */
    public function getSingleBy(array $data = []): Action;

    /**
     * @param array $data
     * 
     * @return Action
     */
    public function create(array $data): Action;

    /**
     * @param Action $Action
     * @param array $data
     * 
     * @return bool
     */
    public function update(Action $action, array $data): bool;

    /**
     * @return array
     */
    public function filters(array $filters): array;
}
