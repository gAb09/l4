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

@stop

@section('zapette')
{{ link_to_action('MenuController@index', 'Retour à la liste', null, array('class' => 'btn btn-info btn-zapette iconesmall list')); }}

{{ Form::submit('Créer ce menu', array('class' => 'btn btn-success')) }}
{{ Form::close() }}
@stop


@section('footer')
@parent
<h3>  Le footer de menus</h3>

@stop