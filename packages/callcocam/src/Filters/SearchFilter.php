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
     * @param mixed $name =null
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value, $name=null)
    {
        if ($value === null) {
            return $builder;
        }

        return $builder->where($name, 'LIKE', "%{$value}%");
    }
}
