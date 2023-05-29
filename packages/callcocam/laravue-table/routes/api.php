<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;
use SIGA\Table\Http\Controllers\Api\TableController;

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('makes', TableController::class);
});
