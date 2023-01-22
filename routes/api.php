<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PokemonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/import', [ImportController::class, 'index']);

Route::get('/pokemon', [PokemonController::class, 'index']);

Route::post('/pokemon/{id}', [PokemonController::class, 'edit']);
Route::delete("/pokemon/{id}", [PokemonController::class, 'delete']);
Route::put('/pokemon/{id}', [PokemonController::class, 'update']);
