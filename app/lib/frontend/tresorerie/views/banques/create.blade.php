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

{{ Form::model($banque, ['method' => 'post', 'action' => 'BanqueController@store']) }}

@include('frontend/tresorerie/views/banques/form')

@stop

@section('zapette')
{{ Form::submit('Créer une nouvelle banque', array('class' => 'btn btn-success')) }}
{{ Form::close() }}
@stop

@section('footer')
@parent
<h3>  Le footer de banques</h3>
@stop