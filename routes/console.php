<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('refresh:pokemon-cache')
    ->dailyAt('12:00')
    ->timezone('Europe/Warsaw');
