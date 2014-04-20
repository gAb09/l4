@extends('compta/layout')

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

{{ Form::open(array('url' => 'compta/comptes', 'method' => 'post')) }}

@include('compta/comptes/form')

<br />{{ Form::submit('créer') }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de comptes</h3>

@stop


