<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;
use SIGA\Menus\Http\Controllers\AdminController;
use SIGA\Menus\Http\Controllers\Api\MenuController;

Route::middleware('auth:sanctum')->group(function () {

    
    Route::get('/load/menus', [AdminController::class, 'loadtMenus']);
    Route::resource('menus', MenuController::class);
});
