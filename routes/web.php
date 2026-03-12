-- Active: 1728608713512@@127.0.0.1@3306
-- Active: 1733506281379@@127.0.0.1@1433
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

use App\Models\Pokemon;
use Illuminate\Http\Request;

Route::get('/pokemons', function () {

    $pokemons = Pokemon::all();

    return view('pokemons', compact('pokemons'));

});
Route::post('/importar', function (Request $request) {

    Pokemon::create([
        'api_id' => $request->api_id,
        'name' => $request->name,
        'height' => $request->height,
        'weight' => $request->weight,
        'sprite' => $request->sprite
    ]);

    return "Pokémon salvo!";
});
Route::get('/buscar', function () {
    return view('search');
});
Route::get('/pokemon', [PokemonController::class, 'search']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


