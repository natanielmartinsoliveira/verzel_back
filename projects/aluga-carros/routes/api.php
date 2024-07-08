<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;


Route::get('/', function (Request $request) {
    echo  "Version 1.0";
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas públicas
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // Rota para logout
    Route::post('/logout', [LoginController::class, 'logout']);

    // Rotas para carros
    Route::group(['prefix' => 'carros'], function () {
        Route::post('/', [CarroController::class, 'store']);
        Route::put('/{id}', [CarroController::class, 'update']);
        Route::delete('/{id}', [CarroController::class, 'destroy']);
    });

    // Rotas para marcas
    Route::group(['prefix' => 'marcas'], function () {
        Route::post('/', [MarcaController::class, 'store']);
        Route::put('/{id}', [MarcaController::class, 'update']);
        Route::delete('/{id}', [MarcaController::class, 'destroy']);
    });
    // Rotas para modelos
    Route::group(['prefix' => 'modelos'], function () {
        Route::post('/', [ModeloController::class, 'store']);
        Route::put('/{id}', [ModeloController::class, 'update']);
        Route::delete('/{id}', [ModeloController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'marcas'], function () {
    Route::get('/', [MarcaController::class, 'index']);
    //Route::get('/modelos', [ModeloController::class, 'indexMarcas']);
    Route::get('/{id}', [MarcaController::class, 'show']);  
});

Route::group(['prefix' => 'modelos'], function () {
    Route::get('/', [ModeloController::class, 'index']);
    Route::get('/marcas/{id}', [ModeloController::class, 'indexMarcas']);
    Route::get('/{id}', [ModeloController::class, 'show']);  
});

Route::group(['prefix' => 'carros'], function () {
    Route::get('/', [CarroController::class, 'index']);
    Route::get('/{id}', [CarroController::class, 'show']);  
});