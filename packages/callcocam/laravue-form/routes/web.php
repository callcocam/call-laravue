<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Illuminate\Support\Facades\Route;

 Route::middleware('auth')->get('/form-manager',  [\SIGA\Http\Controllers\FormManagerController::class, 'index']);
