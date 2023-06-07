<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Http\Controllers\Api;

use Illuminate\Http\Request;
use SIGA\Http\Controllers\AbstractController;
use SIGA\Makes\Models\MakeBoard;

class MakeBoardController extends AbstractController
{

    protected $model = MakeBoard::class;


    protected function rules(Request $request, $model)
    {
        return [
            'name' => ['required'],
            'make_id' => ['required'],
            'icon' => ['required'],
            'ordering' => ['required'],
            'span' => ['required'],
        ];
    }
}
