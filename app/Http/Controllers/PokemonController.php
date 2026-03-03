<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonInfoRequest;
use App\Http\Requests\StorePokemonRequest;
use App\Http\Requests\UpdatePokemonRequest;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use App\Services\PokemonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PokemonController extends Controller
{
    public function index(PokemonInfoRequest $request): AnonymousResourceCollection
    {
        return PokemonResource::collection(
            (new PokemonService())->getCollection()
                ->filter(function(Pokemon $pokemon) use ($request) {
                    return $request->pokemons ?
                        in_array(strtolower($pokemon->getAttribute('name')), $request->pokemons)
                        : $pokemon;
                })
                ->filter(function(Pokemon $pokemon) use ($request) {
                    if($request->filled('created_by_me')){
                        return $pokemon->getAttribute('created_by_me') == true;
                    } else {
                        return $pokemon;
                    }
                })
        );
    }

    public function show(Pokemon $pokemon): PokemonResource
    {
        return new PokemonResource($pokemon);
    }

    public function store(StorePokemonRequest $request): PokemonResource
    {
        $pokemon = Pokemon::query()->create([
            ...$request->validated(),
            ...[
                'created_by_me' => true
            ]
        ]);

        return new PokemonResource($pokemon);
    }

    /**
     * @throws \Throwable
     */
    public function update(UpdatePokemonRequest $request, Pokemon $pokemon): PokemonResource|JsonResponse
    {
        try {
            DB::transaction(function () use ($request, $pokemon) {

                $pokemon->update($request->validated());
            });

            return new PokemonResource($pokemon->refresh());

        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Cos poszlo nie tak, sorki',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function destroy(UpdatePokemonRequest $request, Pokemon $pokemon): JsonResponse
    {
        $pokemon->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
