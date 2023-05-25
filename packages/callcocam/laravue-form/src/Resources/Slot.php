<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form\Resources;


use SIGA\Form\Resources\Columns\Fluent;

class Slot extends Fluent
{

    /**
     * $columns []
     * $span string
     * $name default|left|rigth
     */
    public function __construct(array $columns, string $span = 'col-span-12', string $name = 'default')
    {
        $this->attributes =  [
            'slot' => $name,
            'span' => $span,
            'childrens' => $columns
        ];
    }

    public static function make(array $columns, string $span = 'col-span-12', string $name = 'default')
    {
        $slot = new static($columns, $span, $name);
        return $slot->toArray();
    }
}
