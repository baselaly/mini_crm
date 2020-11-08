<?php

namespace App\QueryFilters\Action;

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
                $query->where('type', 'LIKE', "%" . $filters['keyword'] . "%")->orWhere('description', 'LIKE', "%" . $filters['keyword'] . "%");
            });
        }
        return $builder;
    }
}
