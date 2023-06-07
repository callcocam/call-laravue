<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Http\Controllers\Api;

use Illuminate\Http\Request;
use SIGA\Http\Controllers\AbstractController;
use SIGA\Makes\Events\MakeBoardItemEvent;
use SIGA\Makes\Models\MakeBoardItem;

class MakeBoardItemController extends AbstractController
{

    protected $model = MakeBoardItem::class;

    protected $event = MakeBoardItemEvent::class;


    protected function rules(Request $request, $model)
    {
        return [
            'name' => ['required'],
            'make_board_id' => ['required'],
            'type' => ['required'],
            'ordering' => ['required'],
            'span' => ['required'],
        ];
    }
}
