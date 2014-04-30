@extends('compta/layout')

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

{{ Form::open(array('url' => 'compta/types/'.$type->id, 'method' => 'put')) }}

@include('compta/types/form')

<br />{{ Form::submit('Enregistrer', array('class' => 'btn')) }}
{{ Form::close() }}

{{ Form::open(array('url' => 'compta/types/'.$type->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de types</h3>

@stop