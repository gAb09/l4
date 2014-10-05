@extends('frontend/views/layout')

@section('titre')
@parent


@stop


@section('topcontent1')
		<h1 class="titrepage">{{$titre_page}}</h1>
@stop


@section('topcontent2')
@stop

@section('contenu')
<hr>

{{ Form::model($ecriture, array('name' => 'form', 'url' => 'tresorerie/ecritures', 'method' => 'post', 'action' => 'EcritureController@store')) }}

@include('frontend/tresorerie/views/ecritures/form')

{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}



@stop

@section('tresorerie/footer')
@parent
<h3>  Le footer de création d'écritures</h3>

@stop