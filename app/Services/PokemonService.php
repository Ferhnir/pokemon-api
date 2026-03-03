<?php

namespace App\Services;

use App\Models\Pokemon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class PokemonService
{
    public function forgetCollection(): bool
    {
        return Cache::forget('pokemons');
    }

    public function getCollection()
    {
        return Cache::rememberForever(
            "pokemons",
            fn () => Pokemon::query()
                ->select(['id', 'name', 'banned', 'created_by_me'])
                ->notBanned()
                ->get()
        );
    }
}
