<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PokemonController extends Controller
{
    public function search(Request $request)
    {
        $name = strtolower($request->name);

        try {

            $pokemon = Cache::remember("pokemon_".$name, 300, function () use ($name) {

                $response = Http::get("https://pokeapi.co/api/v2/pokemon/".$name);

                if (!$response->successful()) {
                    return null;
                }

                return $response->json();
            });

            if (!$pokemon) {
                return back()->with('error','Pokemon não encontrado');
            }

            return view('pokemon', compact('pokemon'));

        } catch (\Exception $e) {

            return back()->with('error','Erro ao conectar com a API');

        }
    }
}