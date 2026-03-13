<h1>{{ $pokemon['name'] }}</h1>

<img src="{{ $pokemon['sprites']['front_default'] }}">

<p>Altura: {{ $pokemon['height'] }}</p>
<p>Peso: {{ $pokemon['weight'] }}</p>

<form action="/importar" method="POST">

@csrf

<input type="hidden" name="api_id" value="{{ $pokemon['id'] }}">
<input type="hidden" name="name" value="{{ $pokemon['name'] }}">
<input type="hidden" name="height" value="{{ $pokemon['height'] }}">
<input type="hidden" name="weight" value="{{ $pokemon['weight'] }}">
<input type="hidden" name="sprite" value="{{ $pokemon['sprites']['front_default'] }}">

<button type="submit">Salvar Pokémon</button>

</form>