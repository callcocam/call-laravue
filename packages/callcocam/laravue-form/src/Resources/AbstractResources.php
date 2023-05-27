<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form\Resources;

use SIGA\Form\Resources\Columns\Fluent;

use Illuminate\Support\Str;
use SIGA\Form\Resources\Columns\Traits\WithDecorator;

abstract class AbstractResources extends Fluent implements ResourcesInterface
{
    use WithDecorator;

    public function __construct($label = null, $endpoint = null, $name = null)
    {
        $this->label = $label;
        $this->endpoint = $endpoint;
        $this->name = $name;
    }

    public function init($label, $endpoint, $name = null)
    {
        $this->label = $label;
        $this->endpoint = $endpoint;
        $this->name = $name;
        $this->schema = $this->columns();
        return $this;
    }


    public static function make($label = null, $endpoint = null, $name = null)
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
