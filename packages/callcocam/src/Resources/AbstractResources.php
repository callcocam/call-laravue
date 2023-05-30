<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Resources;


use Illuminate\Support\Str;
use SIGA\Filters\Ordering\ViewsOrder;
use SIGA\Resources\Traits\WithDecorator;
use SIGA\Resources\Traits\WithHidden;

abstract class AbstractResources extends Fluent implements ResourcesInterface
{
    use WithDecorator, WithHidden;

    public function __construct($label = null, $endpoint = null, $name = null)
    {
        $this->label = $label;
        $this->endpoint = $endpoint;
        $this->name = $name;
    }

    public function init($label, $endpoint, $name = null)
    {
        $orderings = [];
        $this->label = $label;
        $this->endpoint = $endpoint;
        $this->name = $name;
        $this->schema = $this->columns();
        foreach ($this->schema as $schema) {
            if ($childrens = data_get($schema, 'childrens', null)) {
                foreach ($childrens as $children) {
                    if (data_get($children, 'props.ordering')) {
                        $orderings[data_get($children, 'props.name')] = ViewsOrder::class;
                    }
                }
            }
        }
       $this->offsetSet('orderings', $orderings);
       
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
