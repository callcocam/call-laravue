<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Resources\Make;

use App\Models\Category; 
use SIGA\Resources\Columns\Field;
use SIGA\Resources\Slot;
use SIGA\Resources\AbstractResources;

class PostResource extends AbstractResources
{


    public function columns()
    {

        return [
            // Slot::make([])->span('4')->slot('left'),
            Slot::make([
                Field::editor('Conteudo', 'content'),
            ])->span('8'),
            Slot::blank()
                ->add(Field::make('Name')->ordering()->searchable()->filter())
                ->add(Field::select('Categorias', 'category_id', Category::query()->pluck('name', 'id')->toArray()))
                ->add(Field::filemanager('File', 'file_manager_id')->model('filemanager'))
                ->add(Field::date('Data de criação', 'created_at')->ordering())
                ->add(Field::date('Data de atualização', 'updated_at'))
                ->add(Field::status('Status'))
                ->add(Field::submit('SALVAR'))
                ->slot('right')->span('4'),
        ];
    }
}
