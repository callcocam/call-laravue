<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Resources\Make;

use SIGA\Form\Resources\AbstractResources;
use SIGA\Form\Resources\Columns\Field;
use SIGA\Form\Resources\Slot;

class CategoryResource extends AbstractResources
{


    public function columns()
    {

        return [
            Slot::make([], 'md:col-span-4', 'left'),
            Slot::make([], 'md:col-span-8'),
            Slot::make([], 'md:col-span-4', 'right'),
        ];
    }
}
