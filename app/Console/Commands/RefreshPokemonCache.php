<?php

namespace App\Console\Commands;

use App\Services\PokemonService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RefreshPokemonCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:pokemon-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        (new PokemonService())->forgetCollection();

        app(PokemonService::class)->getCollection();

        $this->info('Pokemon cache refreshed.');
    }
}
