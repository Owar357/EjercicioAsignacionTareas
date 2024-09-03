<?php

use App\Http\Controllers\TareaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/usuarios', UsuarioController::class);

Route::resource('/tareas', TareaController::class);

Route::put('/estado',[TareaController::class, 'changeState']);