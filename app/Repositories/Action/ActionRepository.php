<?php

namespace App\Repositories\Action;

use App\Models\Action;
use App\QueryFilters\Action\CustomerFilter;
use App\QueryFilters\Action\KeywordFilter;
use Illuminate\Pipeline\Pipeline;

class ActionRepository implements ActionRepositoryInterface
{
    /**
     * @var Action
     */
    private $action;

    /**
     * @param Action $action
     */
    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    /**
     * @return array
     */
    public function filters($filters): array
    {
        return [
            new KeywordFilter($filters),
            new CustomerFilter($filters)
        ];
    }

    /**
     * @param array $data
     * @param int $perPage
     * 
     * @return [type]
     */
    public function getAll(array $data = [], int $perPage = 0)
    {
        $actions = app(Pipeline::class)
            ->send($this->action->query())
            ->through($this->filters($data))
            ->thenReturn()
            ->latest();

        return $perPage ? $actions->paginate($perPage) : $actions->get();
    }

    /**
     * @param array $data
     * 
     * @return Action
     */
    public function getSingleBy(array $data = []): Action
    {
        return app(Pipeline::class)
            ->send($this->action->query())
            ->through($this->filters($data))
            ->thenReturn()
            ->latest()->firstOrFail();
    }

    /**
     * @param array $data
     * 
     * @return Action
     */
    public function create(array $data): Action
    {
        return $this->action->create($data);
    }

    /**
     * @param Action $action
     * @param array $data
     * 
     * @return bool
     */
    public function update(Action $action, array $data): bool
    {
        return $action->update($data);
    }
}
