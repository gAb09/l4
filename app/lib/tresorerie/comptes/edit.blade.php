@extends('tresorerie/layout')

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

@include('tresorerie/comptes/form')

<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
{{ Form::close() }}


@if(!$compte->pco)
{{ Form::open( ['method' => 'delete', 'action' => ['CompteController@destroy', $compte->id]] ) }}
{{ Form::submit('Supprimer', ['class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());']) }}
{{ Form::close() }}
@endif

@stop

@section('zapette')
<p>
	{{ link_to_action('CompteController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
</p>
@stop

@section('footer')
@parent
<h3>  Le footer de comptes</h3>

@stop