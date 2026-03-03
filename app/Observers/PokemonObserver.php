<?php

namespace App\Observers;

use App\Models\Pokemon;
use App\Services\PokemonService;

class PokemonObserver
{
    public function created(Pokemon $pokemon): void
    {
        (new PokemonService())->forgetCollection();
    }

    public function updated(Pokemon $pokemon): void
    {
        (new PokemonService())->forgetCollection();
    }

    public function deleted(Pokemon $pokemon): void
    {
        (new PokemonService())->forgetCollection();
    }
}
