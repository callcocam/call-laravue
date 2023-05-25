<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;
use SIGA\FileManager\Http\Controllers\Api\DirController;
use SIGA\FileManager\Http\Controllers\Api\FileController;
use SIGA\FileManager\Http\Controllers\Api\FilterController;

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('file-manager')->group(function () {
        Route::resource('dirs', DirController::class);
        Route::resource('files',  FileController::class);
        Route::resource('video',  FileController::class);
        Route::resource('filters',  FilterController::class)->only([
            'index', 'store'
        ]);
    });
});
