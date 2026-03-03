<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannedPokemon extends Model
{
    use SoftDeletes;

    protected $table = 'banned_pokemons';

    protected $fillable = ['name'];

}
