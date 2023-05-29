<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Form\Resources\Columns\Traits;

/**
 * WithDecorator
 */
trait WithDecorator
{

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
