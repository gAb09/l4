@extends('compta/layout')

@section('titre')
@parent
: les comptes - édition

@stop


@section('topcontent1')
		<h1 class="titrepage">Édition du compte n° {{$compte->numero}} : {{$compte->libelle}}</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />

{{ Form::open(array('url' => 'compta/comptes/'.$compte->id, 'method' => 'put')) }}

@include('compta/comptes/form')

<br />{{ Form::submit('Enregistrer', array('class' => 'btn')) }}
{{ Form::close() }}

{{ Form::open(array('url' => 'compta/comptes/'.$compte->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de comptes</h3>

@stop