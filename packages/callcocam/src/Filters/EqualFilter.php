<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Filters;


use Illuminate\Database\Eloquent\Builder;
use SIGA\Filters\FilterAbstract;

class EqualFilter extends FilterAbstract
{

    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     * @param mixed $columns =null
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value, $columns = null)
    {
        if ($value === null) {
            return $builder;
        }
        return $builder->where($columns,  $value);
    }
}
