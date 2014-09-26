@extends('frontend/views/layout')

@section('titre')
@parent
: les écriture - création

@stop


@section('topcontent1')
		<h1 class="titrepage">Création d'une nouvelle écriture</h1>
@stop


@section('topcontent2')
@stop

@section('contenu')
<hr>

{{ Form::model($ecriture, array('name' => 'form', 'url' => 'tresorerie/ecritures', 'method' => 'post', 'action' => 'EcritureController@store')) }}

@include('tresorerie/views/ecritures/form')

{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}



@stop

@section('tresorerie/footer')
@parent
<h3>  Le footer de création d'écritures</h3>

@stop