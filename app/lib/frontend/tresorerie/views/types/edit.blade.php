@extends('frontend/views/layout')

@section('titre')
@parent
: les types d'écriture - édition

@stop


@section('topcontent1')
		<h1 class="titrepage">Édition du type n° {{$type->id}} : {{$type->nom}}</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />

{{ Form::open(['method' => 'PUT', 'action' => ['TypeController@update', $type->id]]) }}

@include('tresorerie/views/types/form')

<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
{{ Form::close() }}

{{ Form::open(array('url' => 'tresorerie/types/'.$type->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', ['class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());']) }}
{{ Form::close() }}

@stop

@section('zapette')
<p>
	{{ link_to_action('TypeController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
</p>
@stop

@section('footer')
@parent
<h3>  Le footer de types</h3>

@stop