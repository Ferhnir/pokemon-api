<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanPokemonRequest;
use App\Http\Resources\BannedPokemonResource;
use App\Http\Resources\PokemonResource;
use App\Models\BannedPokemon;
use App\Models\Pokemon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BannedPokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return PokemonResource::collection(
            Pokemon::query()
                ->where('banned', true)
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(BanPokemonRequest $request): JsonResponse
    {
        $pokemon = Pokemon::query()->findOrFail($request->pokemon_id);
        $pokemon->update(['banned' => true]);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BanPokemonRequest $request): JsonResponse
    {
        $pokemon = Pokemon::query()->findOrFail($request->pokemon_id);
        $pokemon->update(['banned' => false]);

        return response()->json([
            'message' => 'Pokemon odbanowany'
        ])->setStatusCode(Response::HTTP_OK);
    }
}
