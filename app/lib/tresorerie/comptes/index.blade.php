@extends('tresorerie/layout')

@section('titre')
@parent
: les comptes

@stop


@section('topcontent1')

<h1 class="titrepage">{{ $titre_page }}</h1>
<a href ="{{ URL::route('tresorerie.comptes.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter un nouveau compte</a><br /><br />
{{ link_to_action('CompteController@index', 'Voir tous les comptes', null, array('class' => "badge badge-locale iconemedium list", 'style' => "font-size:1.1em")) }}

@stop


@section('topcontent2')

@foreach($classes as $classe)
<div class="classeRacine">Classe {{ $classe->numero }} :
	<br />{{ link_to_action('CompteController@index', $classe->libelle, $classe->numero) }}<br /></div>
	@endforeach

	@stop


	@section('contenu')

	@foreach($comptes as $compte)
	<hr />
	<div class="compte">
		<div class="compte {{ $compte->classe_actif }}">

			<h4 class=" {{ $compte->class_pco }}">{{ $compte->numero }} – {{ $compte->libelle }}</h4>

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
			{{link_to_route('tresorerie.comptes.edit', 'Modifier ce compte', $compte->id)}}
		</p>

		@endforeach
		@stop

		@section('footer')
		@parent
		<h3>  Le footer de comptes</h3>

		@stop
