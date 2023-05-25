<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form\Resources;

use SIGA\Form\Resources\Columns\Fluent;

use Illuminate\Support\Str;

abstract class AbstractResources extends Fluent implements ResourcesInterface
{

    public function __construct($label, $endpoint, $name = null)
    {
        $this->label = $label;
        $this->endpoint = $endpoint;
        $this->name = $name;
    }


    public static function make($label, $endpoint, $name = null)
    {
        $resource = new static($label,  $endpoint, $name);
        $resource->schema = $resource->columns();
        return $resource;
    }

    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }
}
