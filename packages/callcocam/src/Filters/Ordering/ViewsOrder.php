<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Filters\Ordering;


use Illuminate\Database\Eloquent\Builder;
use SIGA\Filters\FilterAbstract;

class ViewsOrder extends FilterAbstract
{
    /**
     * Order by views in descending
     *
     * @param Builder $builder
     * @param $direction
     * @param $columns=null
     * @return Builder
     */
    public function filter(Builder $builder, $direction, $columns = null)
    {
        if (is_array($columns)) {
            $column = request()->query('column');
            if (in_array($column, $columns)) {
               
                return $builder->orderBy($column, $this->resolveOrderDirection($direction));
            }
            return $builder;
        }
        return $builder->orderBy($columns, $this->resolveOrderDirection($direction));
    }
}
