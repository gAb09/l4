@extends('compta/layout')

@section('titre')
@parent
: les types d'écriture - création

@stop


@section('topcontent1')
		<h1 class="titrepage">Création d'un nouveau “type d'écriture”</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')
<hr>

{{ Form::open(array('url' => 'compta/types', 'method' => 'post')) }}

@include('compta/types/form')

<br />{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de types</h3>

@stop


