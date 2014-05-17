@extends('compta/layout')

@section('titre')
@parent
: les comptes

@stop


@section('topcontent1')
<h1 class="titrepage">Les comptes</h1>
<a href ="{{ URL::route('compta.comptes.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter un nouveau compte</a>
@stop


@section('topcontent2')
@foreach($roots as $root)
{{ $root->numero }}{{ $root->libelle }}<br />
@endforeach
@stop


@section('contenu')


@foreach($comptes as $compte)
<hr />
<div class="compte">
	<div class="compte  {{ $compte->classe_actif }}">

		<h4 class=" {{ $compte->classe_pco }}">{{ $compte->numero }} – {{ $compte->libelle }}</h4>

			<div>
			@if ($compte->description_officiel) 
			<h5 class="pco">Description officielle (Wikipédia) :</h5>
			<p class="pco">{{ $compte->description_officiel }}</p>
			@endif
			</div>

			<div>
			@if ($compte->description_comp)
			<h5>Informations complémentaires :</h5>
			<p>{{ $compte->description_comp }}</p>
			@endif
			</div>

			<div>
			@if ($compte->description_lmh)
			<h5>Compte spécifique La Mauvaise Herbe :</h5>
			<p>{{ $compte->description_lmh }}</p>
			@endif
			</div>
		</div>

		<p class="badge badge-locale iconesmall edit">
			{{link_to_route('compta.comptes.edit', 'Modifier ce compte', $compte->id)}}
		</p>
		@endforeach

		@stop

		@section('footer')
		@parent
		<h3>  Le footer de comptes</h3>

		@stop
