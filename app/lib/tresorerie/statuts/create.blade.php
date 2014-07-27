@extends('tresorerie/layout')

@section('titre')
@parent
: les statuts - création
@stop


@section('topcontent1')
		<h1 class="titrepage">Création d'un nouveau statut</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

{{ Form::model($statut, ['method' => 'post', 'route' => 'tresorerie.statuts.store']) }}

@include('admin/statuts/form')

<br />
{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de statuts</h3>
@stop