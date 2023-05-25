<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Illuminate\Support\Facades\Route;

 Route::middleware('auth')->get('/file-manager',  [\SIGA\Http\Controllers\FileManagerController::class, 'index']);
