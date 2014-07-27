@extends('tresorerie/layout')

@section('titre')
@parent
: les comptes - création

@stop


@section('topcontent1')
<h1 class="titrepage">Création d'un nouveau “compte”</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')
<hr>
{{ Form::open(['method' => 'post', 'action' => 'CompteController@store']) }}

@include('tresorerie/comptes/form')

<br />{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de comptes</h3>

@stop


