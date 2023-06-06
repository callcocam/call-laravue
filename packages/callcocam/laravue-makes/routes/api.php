<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;
use SIGA\Makes\Http\Controllers\Api\MakeController;
use SIGA\Makes\Http\Controllers\Api\MakeFieldController;

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('makes', MakeController::class);
    Route::resource('make/fields', MakeFieldController::class);
});
