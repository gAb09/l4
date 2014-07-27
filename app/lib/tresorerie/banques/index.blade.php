@extends('tresorerie/layout')

@section('titre')
@parent
: les banques

@stop


@section('topcontent1')
		<h1 class="titrepage">Les banques</h1>
@stop


@section('topcontent2')
		<a href ="{{ URL::action('BanqueController@create') }}" class="badge badge-locale iconemedium add"
		style="font-size:1.1em">Ajouter une nouvelle banque</a>
@stop


@section('contenu')

<hr />

@foreach($banques as $banque)

<h2 class="item">{{ $banque->nom }}</h2>
<h5>Description :</h5><p>{{ $banque->description }}</p>
<p class="badge badge-locale iconesmall edit">
	{{link_to_action('BanqueController@edit', 'Modifier cette banque', $banque->id)}}
</p>
<hr />
@endforeach

@stop

@section('tresorerie/footer')
@parent
<h3>  Le footer de banques</h3>
@stop

