<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Makes\Resources;

use SIGA\Form\Resources\AbstractResources;
use SIGA\Form\Resources\Columns\Field;
use SIGA\Form\Resources\Slot;

class MakeResource extends AbstractResources
{


    public function columns()
    {

        $rigth =  [
            Field::date('Data de criação', 'created_at'),
            Field::date('Última de atualização', 'updated_at'),
            Field::make('Status'),
            Field::submit('SALVAR'),
        ];
        $default = [
            Field::make('Nome do app', 'name')->md(6),
            Field::make('Nome da rota', 'route'),
            Field::make('Nome da url', 'path'),
            Field::make('Descrição', 'description'),
        ];
        return [
            Slot::make($default, 'md:col-span-8'),
            Slot::make($rigth, 'md:col-span-4', 'right')
        ];
    }
}
