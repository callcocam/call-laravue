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
            // Slot::make([])->span('4')->slot('left'),
            Slot::make([
                Field::make('Name'),
                Field::textarea('Conteudo', 'content'),
            ])->span('8'),
            Slot::blank()
                ->add(Field::date('Data de criação', 'created_at'))
                ->add(Field::date('Data de atualização', 'updated_at'))
                ->add(Field::radio('Status')->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ]))
                ->add(Field::submit('SALVAR'))
                ->slot('right')->span('4'),
        ];
    }
}
