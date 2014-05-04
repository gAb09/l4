@extends('compta/layout')

@section('titre')
@parent
: les comptes

@stop


@section('topcontent1')
<h1 class="titrepage">Les comptes</h1>
@stop


@section('topcontent2')
<a href ="{{ URL::route('compta.comptes.create') }}" class="badge badge-locale iconemedium add"
style="font-size:1.1em">Ajouter un nouveau compte</a>
@stop


@section('contenu')


@foreach($comptes as $compte)
<hr />
@if($compte->actif == 1)
<div class="compte actif">
	@else
	<div class="compte">
		@endif
		<h3>{{ $compte->numero }} 
			@if($compte->lmh == 1) 
			<small> — Compte spécifique La Mauvaise Herbe</small></h3>
			@endif

			<h4>{{ $compte->libelle }}</h4>

			@if ($compte->description_officiel) 
			<h5>Description officielle (Wikipédia) :</h5>
			<p>{{ $compte->description_officiel }}</p>
			@endif

			@if ($compte->description_comp)
			<h5>Complément :</h5>
			<p>{{ $compte->description_comp }}</p>
			@endif

			@if ($compte->description_lmh)
			<h5>La Mauvaise Herbe : </h5>
			<p>{{ $compte->description_lmh }}</p>
			@endif

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
