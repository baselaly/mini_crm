<?php

namespace App\QueryFilters\Customer;

use Closure;

class KeywordFilter
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (array_key_exists('keyword', $this->filters) && isset($this->filters['keyword'])) {
            $filters = $this->filters;
            return $builder->where(function ($query) use ($filters) {
                $query->where('name', 'LIKE', "%" . $filters['keyword'] . "%")->orWhere('email', 'LIKE', "%" . $filters['keyword'] . "%")
                    ->orWhere('phone', 'LIKE', "%" . $filters['keyword'] . "%")->orWhere('source', "%" . $filters['keyword'] . "%");
            });
        }
        return $builder;
    }
}
