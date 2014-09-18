@extends('shared/views/layout')

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

{{ Form::model($banque, ['method' => 'PUT', 'action' => ['BanqueController@update', $banque->id]]) }}

@include('tresorerie/views/banques/form')

<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
{{ Form::close() }}

{{ Form::open(['method' => 'delete', 'action' => ['BanqueController@destroy', $banque->id]]) }}
{{ Form::submit('Supprimer', array('class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());')) }}
{{ Form::close() }}

@stop

@section('zapette')
<p>
	{{ link_to_action('BanqueController@index', 'Retour à la liste', null, array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
</p>
@stop

@section('footer')
@parent
<h3>  Le footer de banques</h3>

@stop