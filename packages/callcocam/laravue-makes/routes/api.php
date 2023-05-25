<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;
use SIGA\Makes\Http\Controllers\Api\MakeController;

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('makes', MakeController::class);
});
