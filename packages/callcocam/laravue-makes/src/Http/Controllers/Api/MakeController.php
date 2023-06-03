<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Http\Controllers\Api;

use SIGA\Http\Controllers\AbstractController;
use SIGA\Makes\Models\Make;
use SIGA\Makes\Resources\MakeResource;

class MakeController extends AbstractController
{

    protected $model = Make::class;

    protected $resourse = MakeResource::class;
    
}
