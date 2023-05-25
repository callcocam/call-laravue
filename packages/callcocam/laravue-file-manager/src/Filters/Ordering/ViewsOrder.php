<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\FileManager\Filters\Ordering;


use Illuminate\Database\Eloquent\Builder;
use SIGA\Filters\FilterAbstract;

class ViewsOrder extends FilterAbstract
{
    /**
     * Order by views in descending
     *
     * @param Builder $builder
     * @param $direction
     * @return Builder
     */
    public function filter(Builder $builder, $direction)
    {
        return $builder->orderBy('ordering', $this->resolveOrderDirection($direction));
    }
}
