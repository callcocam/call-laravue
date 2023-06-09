<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Http\Controllers\Api;

use Illuminate\Http\Request;
use SIGA\Http\Controllers\AbstractController;
use SIGA\Makes\Models\MakeField;
use SIGA\Makes\Resources\MakeFieldResource;

class MakeFieldController extends AbstractController
{

    protected $model = MakeField::class;
 
    protected function rules(Request $request, $model)
    {
        return [
            'name' => ['required'], 
            'type' => ['required'],
            'ordering' => ['required'],
            'span' => ['required'],
        ];
    }
    
}
