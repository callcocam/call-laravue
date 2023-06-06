<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Resources;

use SIGA\Resources\AbstractResources;
use SIGA\Resources\Slot;

class MakeFieldResource extends AbstractResources
{


    public function columns()
    {
        return [
            Slot::blank()
                ->add($this->input('Name')->ordering()->searchable()->filter())
                ->timestamps(['ordering' => true])
                ->status(['ordering' => true])
                ->submit()
                ->editor()->span('12')
        ];
    }
}
