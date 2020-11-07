<?php

namespace App\Repositories\User;

use App\Models\User;
use App\QueryFilters\User\IdFilter;
use App\QueryFilters\User\KeywordFilter;
use Illuminate\Pipeline\Pipeline;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
            ->send($this->user->query())
            ->through([
                new KeywordFilter($data),
                new IdFilter($data)
            ])
            ->thenReturn()
            ->latest()->paginate($perPage);
    }

    /**
     * @param array $data
     * 
     * @return User
     */
    public function getSingleBy(array $data = []): User
    {
        return app(Pipeline::class)
            ->send($this->user->query())
            ->through([
                new KeywordFilter($data),
                new IdFilter($data)
            ])
            ->thenReturn()
            ->latest()->firstOrFail();
    }

    /**
     * @param array $data
     * 
     * @return User
     */
    public function create(array $data): User
    {
        return $this->user->create($data);
    }

    /**
     * @param User $user
     * @param array $data
     * 
     * @return bool
     */
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }
}
