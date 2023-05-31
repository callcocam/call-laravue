<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Resources;


use Illuminate\Support\Str;
use SIGA\Filters\Ordering\ViewsOrder;
use SIGA\Filters\SearchFilter;
use SIGA\Resources\Columns\Field;
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

    public function init($label, $endpoint = null, $name = null)
    {
        $orderings = [];
        $searchables = [];
        $colums = [];
        $this->label = Str::afterLast($label, '\\');
        $this->label = Str::plural($this->label);
        $this->endpoint = Str::lower($this->label);
        $this->name = $name;
        $this->schema = $this->columns();
        $filters = $this->filters();
        foreach ($this->schema as $schema) {
            if ($childrens = data_get($schema, 'childrens', null)) {
                foreach ($childrens as $children) {
                    if (data_get($children, 'props.ordering')) {
                        $colums['order'][data_get($children, 'props.name')] = data_get($children, 'props.name');
                        $orderings['order'] = [
                            'column' => $colums['order'],
                            'filter' => ViewsOrder::class
                        ];
                    }
                    if (data_get($children, 'props.searchable')) {
                        $colums['search'][data_get($children, 'props.name')] = data_get($children, 'props.name');
                        $searchables['search'] = [
                            'column' => $colums['search'],
                            'filter' => SearchFilter::class
                        ];
                    }
                }
            }
        }
        $filters  = array_merge($orderings, $searchables);

        $this->offsetSet('filters',  $filters);

        return $this;
    }


    public static function make($label = null, $endpoint = null, $name = null)
    {
        $resource = new static($label,  $endpoint, $name);
        $resource->schema = $resource->columns();
        $resource->filters = $resource->filters();
        return $resource;
    }


    public function input($label, $name = null)
    {
        return Field::make($label, $name);
    }

    public function icon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function filters()
    {
        return [];
    }

    public function getFilters()
    {
        return $this->filters;
    }
}
