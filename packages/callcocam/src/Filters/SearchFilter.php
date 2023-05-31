<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Filters;


use Illuminate\Database\Eloquent\Builder;
use SIGA\Filters\FilterAbstract;

class SearchFilter extends FilterAbstract
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
        if (is_array($columns)) {
            $Search = implode(",", $columns);
            return $builder->where(app('db')->raw("CONCAT_WS(' ', {$Search})"), 'LIKE', "%{$value}%");
        } else {
            return $builder->where($columns, 'LIKE', "%{$value}%");
        }
    }
}
