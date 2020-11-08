<?php

namespace App\QueryFilters\Customer;

use Closure;

class EmployeeFilter
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (array_key_exists('employee_id', $this->filters) && isset($this->filters['employee_id'])) {
            return $builder->where('employee_id', $this->filters['employee_id']);
        }
        return $builder;
    }
}
