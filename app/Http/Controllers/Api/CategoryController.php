<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use SIGA\Http\Controllers\AbstractController;

class CategoryController extends AbstractController
{
     protected $model = \App\Models\Category::class;
     
    protected $resourse = \App\Resources\Make\CategoryResource::class;
    
   
    protected function rules(Request $request, $model)
    {
        return [
            'name'=>['required']
        ];
    }
}
