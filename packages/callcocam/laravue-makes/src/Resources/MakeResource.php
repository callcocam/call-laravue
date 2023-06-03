<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Resources;

use SIGA\Resources\AbstractResources;
use SIGA\Resources\Slot;

class MakeResource extends AbstractResources
{


    public function columns()
    {

        return [
            Slot::blank()
                ->editor()->span('8'),
            Slot::blank()
                ->add($this->input('Name')->ordering()->searchable()->filter())
                ->timestamps(['ordering' => true])
                ->status(['ordering' => true])
                ->submit()
                ->slot('right')->span('4'),
        ];
    }
}
