@extends('shared/views/layout')

@section('titre')
@parent
: les statuts - édition

@stop


@section('topcontent1')
		<h1 class="titrepage">Édition du statut n° {{$statut->id}} : {{$statut->nom}}</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')


{{ Form::model($statut, ['method' => 'PUT', 'route' => ['tresorerie.statuts.update', $statut->id]]) }}

@include('admin/statuts/form')

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}

	{{ Form::open(array('url' => 'admin/statuts/'.$statut->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', ['class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());']) }}
	{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de statuts</h3>

@stop