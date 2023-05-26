<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form\Resources\Columns;

use Illuminate\Support\Str;
use SIGA\Form\Resources\Columns\Traits\WithDecorator;

class Field extends Fluent
{

    use WithDecorator;
    
    public function __construct($label, $name = null)
    {
        if (!$name) {
            $name = Str::snake($label);
        }

        $this->offsetSet(
            'props',
            [
                'label' => $label,
                'name' => $name,
                'type' => 'text',
            ]
        );
    }

    public static function make($label, $name = null)
    {
        $field = new static($label, $name);

        return $field;
    }


    public static function date($label, $name = null)
    {
        $field = new static($label, $name);

        $props = $field->props;

        $field->offsetSet('props', array_merge($props, ['type' => 'date']));

        return $field;
    }

    public static function submit($label, $name = null)
    {
        $field = new static($label, $name);

        $props = $field->props;

        $submit = [
            'type' => 'submit',
            'disableErrors' => true,
            'styles' => 'rounded',
            'variant' => 'primary',
            'icon' => 'fa-regular-save',
        ];

        $field->offsetSet('props', array_merge($props, $submit));


        return $field;
    }
}
