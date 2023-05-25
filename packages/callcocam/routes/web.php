<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/admin/{vue_capture?}', [SIGA\Http\Controllers\AdminController::class, 'index'])
        ->where('vue_capture', '[\/\w\.\,\-]*')
        ->name('admin');
});