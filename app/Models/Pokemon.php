<?php

namespace App\Models;

use App\Observers\PokemonObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


#[ObservedBy([PokemonObserver::class])]
class Pokemon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'banned',
        'created_by_me',
    ];

    public function scopeNotBanned($query)
    {
        return $query->where('banned', false);
    }
}
