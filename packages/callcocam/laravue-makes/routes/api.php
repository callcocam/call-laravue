<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;
use SIGA\Makes\Http\Controllers\Api\MakeController;
use SIGA\Makes\Http\Controllers\Api\MakeFieldController;
use SIGA\Makes\Http\Controllers\Api\MakeBoardController;
use SIGA\Makes\Http\Controllers\Api\MakeBoardItemController;
use SIGA\Makes\Http\Controllers\Api\MakeBoardItemOptionController;

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('makes', MakeController::class);
    Route::resource('make/fields', MakeFieldController::class);
    Route::resource('make/boards', MakeBoardController::class);
    Route::resource('make/board/items', MakeBoardItemController::class);
    Route::resource('make/board/item/options', MakeBoardItemOptionController::class);
});
