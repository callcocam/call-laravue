<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\FileManager\Filters;


use Illuminate\Database\Eloquent\Builder;
use SIGA\Filters\FilterAbstract;

class TrashedFilter extends FilterAbstract
{

    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value, $name=null)
    {
        if ($value === null) {
            return $builder;
        }

        return $builder->withTrashed()->whereNotNull('deleted_at');
    }
}
