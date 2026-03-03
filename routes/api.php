<?php

use App\Http\Controllers\BannedPokemonController;
use App\Http\Controllers\PokemonController;

Route::post('/info', [PokemonController::class, 'index']);

Route::middleware('authConnection')->group(function () {
    Route::apiResource('banned', BannedPokemonController::class)
        ->only(['index', 'store', 'destroy'])
        ->parameters(['banned' => 'name']);

    Route::apiResource('pokemons', PokemonController::class)
        ->except(['index']);
});

