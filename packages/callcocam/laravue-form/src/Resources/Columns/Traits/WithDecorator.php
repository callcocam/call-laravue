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
    
    public function md($col)
    { 
        $this->offsetSet('props', array_merge($this->props,['span'=>sprintf('md:col-span-%s', $col)]));

        return $this;
    }

}
