<?php

namespace App\QueryFilters\User;

use Closure;

class RoleFilter
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (array_key_exists('roles', $this->filters) && isset($this->filters['roles'])) {
            $filters = $this->filters;

            return $builder->whereHas('roles', function ($query) use ($filters) {
                $query->whereIn('name', $filters['roles']);
            });
        }
        return $builder;
    }
}
