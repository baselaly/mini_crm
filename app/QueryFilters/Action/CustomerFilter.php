<?php

namespace App\QueryFilters\Action;

use Closure;

class CustomerFilter
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (array_key_exists('customer_id', $this->filters) && isset($this->filters['customer_id'])) {
            return $builder->where('customer_id', $this->filters['customer_id']);
        }
        return $builder;
    }
}
