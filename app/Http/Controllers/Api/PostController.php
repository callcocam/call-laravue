<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace App\Http\Controllers\Api;

use SIGA\Http\Controllers\AbstractController;

class PostController extends AbstractController
{
     protected $model = \App\Models\Post::class;
     
    protected $resourse = \App\Resources\Make\PostResource::class;
}
