<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Filters;


use Illuminate\Database\Eloquent\Builder;
use SIGA\Filters\FilterAbstract;
use Carbon\Carbon;

class RangerFilter extends FilterAbstract
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
        $data[] = request()->query('start', now()->subYears(5)->format('Y-m-d'));
        $data[] = request()->query('end', now()->addYears(5)->format('Y-m-d'));
        $rangeDate = request()->query('range');
        return $builder->when(array_filter($data), function ($query, $val) use ($rangeDate) {
            $query->whereBetween($rangeDate,  $val);
        });
    }
}
