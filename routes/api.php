<?php

use App\Http\Controllers\BannedPokemonController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\PokemonInfoController;


Route::middleware('authConnection')->group(function () {
    Route::apiResource('banned', BannedPokemonController::class)
        ->only(['index', 'store', 'destroy'])
        ->parameters(['banned' => 'name']);

    Route::apiResource('pokemons', PokemonController::class)
        ->except(['index']);
});

Route::post('/info', [PokemonController::class, 'index']);

