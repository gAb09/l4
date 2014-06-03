@extends('compta/layout')

@section('titre')
@parent
: les comptes - édition

@stop


@section('topcontent1')
		<h1 class="titrepage  ">Édition du compte n° {{$compte->numero}} : <span class="{{ $compte->class_pco }}">{{$compte->libelle}}</span></h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />

{{ Form::open(['method' => 'PUT', 'action' => ['CompteController@update', $compte->id]]) }}

@include('compta/comptes/form')

<br />{{ Form::submit('Enregistrer', array('class' => 'btn')) }}
{{ Form::close() }}


@if(!$compte->pco)
{{ Form::open( ['method' => 'delete', 'action' => ['CompteController@destroy', $compte->id]] ) }}
{{ Form::submit('Supprimer', ['class' => 'btn', 'onClick' => 'javascript:return(confirmation());']) }}
{{ Form::close() }}
@endif

@stop

@section('footer')
@parent
<h3>  Le footer de comptes</h3>

@stop