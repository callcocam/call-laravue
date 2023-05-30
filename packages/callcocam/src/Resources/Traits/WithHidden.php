<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Resources\Traits;

/**
 * WithHidden
 */
trait WithHidden
{


    public function hideList($hideList= true)
    {
        $this->offsetSet('props', array_merge($this->props, ['hideList' => $hideList]));

        return $this;
    }
}
