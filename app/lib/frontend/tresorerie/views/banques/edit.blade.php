@extends('frontend/views/layout')

@section('titre')
@parent
@stop


@section('topcontent1')
<h1 class="titrepage">{{$titre_page}} <small>(Id = {{$banque->id}})</small></h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />

{{ Form::model($banque, ['method' => 'PUT', 'action' => ['BanqueController@update', $banque->id]]) }}

@include('frontend/tresorerie/views/banques/form')



@stop

@section('zapette')
{{ link_to_action('BanqueController@index', 'Retour à la liste', null, array('class' => 'btn btn-info btn-zapette iconesmall list')); }}

{{ Form::submit('Enregistrer', array('class' => 'btn btn-success btn-zapette')) }}
{{ Form::close() }}

{{ Form::open(['method' => 'delete', 'action' => ['BanqueController@destroy', $banque->id]]) }}
{{ Form::submit('Supprimer', array('class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());')) }}
{{ Form::close() }}
@stop

@section('footer')
@parent
<h3>  Le footer de banques</h3>

@stop