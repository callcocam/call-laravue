<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Resources;

use SIGA\Resources\Columns\Field;
use SIGA\Resources\Fluent;
use SIGA\Resources\Traits\WithDecorator;

class Slot extends Fluent
{
    use WithDecorator;

    /**
     * $columns []
     * $span string
     * $name default|left|rigth
     */
    public function __construct(array $columns, string $span = 'col-span-12', string $name = 'default')
    {
        $this->attributes =  [
            'slot' => $name,
            'span' => [$span],
            'childrens' => $columns
        ];
    }

    public static function blank()
    {
        $slot = new static([]);

        return $slot;
    }

    public static function make(array $columns, string $span = 'col-span-12', string $name = 'default')
    {
        $slot = new static($columns, $span, $name);

        return $slot;
    }

    public function slot($slot = "default")
    {
        $this->offsetSet('slot', $slot);

        return $this;
    }

    public function add(Field $column)
    {
        $columns = $this->get('childrens', []);
        $columns[] = $column;

        $this->offsetSet('childrens', $columns);

        return $this;
    }
}
