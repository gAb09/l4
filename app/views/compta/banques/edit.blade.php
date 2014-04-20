@extends('compta/layout')

@section('titre')
@parent
: les banques - édition

@stop


@section('topcontent1')
		<h1 class="titrepage">Édition de la banque n° {{$banque->id}} : {{$banque->nom}}</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />

{{ Form::model($banque, ['method' => 'PUT', 'route' => ['compta.banques.update', $banque->id]]) }}

@include('compta/banques/form')

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn')) }}
	{{ Form::close() }}

	{{ Form::open(array('url' => 'compta/banques/'.$banque->id, 'method' => 'delete')) }}
	{{ Form::submit('Supprimer', array('class' => 'btn')) }}
	{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de banques</h3>

@stop