@extends('frontend/views/layout')

@section('titre')
@parent
: les banques - création
@stop


@section('topcontent1')
		<h1 class="titrepage">Création d'une nouvelle “banque”</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')
<hr>

{{ Form::model($banque, ['method' => 'post', 'action' => 'BanqueController@store']) }}

@include('tresorerie/views/banques/form')

<br />
{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de banques</h3>
@stop