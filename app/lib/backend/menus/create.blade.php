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


	{{ Form::open(array('url' => URL::to('backend/menus'), 'method' => 'post')) }}

@include('backend/menus/form')

	<br />{{ Form::submit('Créer', array('class' => 'btn')) }}
	{{ Form::close() }}

@stop

@section('zapette')
retour à la liste
@stop


@section('footer')
@parent
<h3>  Le footer de menus</h3>

@stop