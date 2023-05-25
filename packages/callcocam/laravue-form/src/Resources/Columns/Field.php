<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form\Resources\Columns;

use Illuminate\Support\Str;

class Field extends Fluent
{

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

    public static function submit($label, $name = null)
    {
        $field = new static($label, $name);
        
        $field->offsetSet(
            'props',
            [
                'label' => $label,
                'type' => 'text',
                'type' => 'submit',
                'disableErrors' => true,
                'styles' => 'rounded',
                'variant' => 'primary',
                'icon' => 'fa-regular-save',
            ]
        );

        return $field;
    }
}
