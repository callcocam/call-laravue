<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    protected $filters = [];

    /**
     * The request.
     *
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * Construct filter with request.
     *
     * @param Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Add filters.
     *
     * @param array $filters
     * @return FiltersAbstract
     */
    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    /**
     * Apply filters.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $value) {
            if ($class = $this->resolveFilter($filter, $value, $builder)) {
                $class->filter($builder, $value, $filter);
            }
        }

        return $builder;
    }

    /**
     * Instantiate a filter.
     *
     * @param  string $filterKey
     * @return mixed
     */
    protected function resolveFilter($filterKey, $value, $builder)
    {
        if ($filterClass = $this->filters[$filterKey]) {
            if (is_string($filterClass)) {
                return new $filterClass;
            }
        }

        if (is_array($filterClass)) { 
            $column = data_get($filterClass, 'column');
            $class = data_get($filterClass, 'filter'); 
            (new $class)->filter($builder, $value, $column);
        }
    }

    /**
     * Get filters to be used.
     *
     * @return array
     */
    protected function getFilters()
    {
        return $this->filterFilters($this->filters);
    }

    /**
     * Filter filters that are only in the request.
     *
     * @param  array $filters
     * @return array
     */
    protected function filterFilters($filters)
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }
}
