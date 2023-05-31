<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Resources\Make;

use App\Models\Category;
use App\Models\User;
use SIGA\Filters\SearchFilter;
use SIGA\Models\Tenant;
use SIGA\Resources\Columns\Field;
use SIGA\Resources\Slot;
use SIGA\Resources\AbstractResources;

class PostResource extends AbstractResources
{

    
    public function filters()
    {
        return [ 
        ];
    }


    public function columns()
    {

        return [
            Slot::blank()
            ->editor()->span('8'),
            Slot::blank()
                ->add($this->input('Name')->ordering()->searchable()->filter())
                ->hasMany(Category::class)
                ->filemanager()
                ->timestamps(['ordering'=>true])
                ->status(['ordering'=>true])
                ->submit() 
                ->slot('right')->span('4'),
        ];
    }
}
