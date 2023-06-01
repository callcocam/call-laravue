<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Filters;


use SIGA\Filters\Ordering\ViewsOrder;
use SIGA\Filters\FiltersAbstract;

class Filters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'range' => RangerFilter::class,
        'search' => SearchFilter::class,
        'ordering' => ViewsOrder::class
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mappings()
    {


        return [];
    }
}
