<?php

namespace App\QueryFilters\User;

use Closure;

class IdFilter
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (array_key_exists('id', $this->filters) && isset($this->filters['id'])) {
            return $builder->where('id', $this->filters['id']);
        }
        return $builder;
    }
}
