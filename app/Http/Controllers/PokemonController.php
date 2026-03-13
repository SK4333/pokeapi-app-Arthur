<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->name;

        $response = Http::get("https://pokeapi.co/api/v2/pokemon/".$name);

        $pokemon = $response->json();

        return view('pokemon', compact('pokemon'));
    }

    public function index()
    {
        $pokemons = Pokemon::all();
        return view('pokemons', compact('pokemons'));
    }

    public function import(Request $request)
    {
        Pokemon::create([
            'api_id' => $request->api_id,
            'name' => $request->name,
            'height' => $request->height,
            'weight' => $request->weight,
            'sprite' => $request->sprite
        ]);

        return redirect('/pokemons');
    }
}