<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Resources\Traits;

/**
 * WithDecorator
 */
trait WithDecorator
{

    public function ordering()
    {
        $this->offsetSet('props', array_merge($this->props, ['ordering' => true]));

        return $this;
    }

    public function sortable()
    {
        $this->offsetSet('props', array_merge($this->props, ['sortable' => true]));

        return $this;
    }

    public function searchable()
    {
        $this->offsetSet('props', array_merge($this->props, ['searchable' => true]));

        return $this;
    }

    public function filter()
    {
        $this->offsetSet('props', array_merge($this->props, ['filter' => true]));

        return $this;
    }

    public function model($model)
    {
        $this->offsetSet('props', array_merge($this->props, ['model' => $model]));

        return $this;
    }

    public function span($span)
    {
        $this->offsetSet('span',  array_merge($this->get('span', []), [sprintf('md:col-span-%s', $span)]));

        return $this;
    }

    public function md($col)
    {
        $this->offsetSet('props', array_merge($this->props, ['span' => sprintf('md:col-span-%s', $col)]));

        return $this;
    }

    public function type($type)
    {
        $this->offsetSet('props', array_merge($this->props, ['type' => $type]));

        return $this;
    }

    public function options($options)
    {
        $this->offsetSet('props', array_merge($this->props, ['options' => $options]));

        return $this;
    }
}
