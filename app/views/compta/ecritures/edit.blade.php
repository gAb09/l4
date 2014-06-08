@extends('compta/layout')

@section('titre')
@parent
: les écritures - édition

@stop


@section('topcontent1')
<h1 class="titrepage">Édition de l'écriture “{{$ecriture->libelle}} {{$ecriture->libelle_detail}}” (n°{{$ecriture->id}})</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

<hr />
{{ Form::model($ecriture, ['name' => 'form', 'method' => 'put', 'route' => ['compta.ecritures.update', $ecriture->id]]) }}



@include('compta/ecritures/form')

{{ Form::submit('Enregistrer', array('class' => 'btn')) }}
{{ Form::close() }}

{{ Form::open(array('url' => 'compta/ecritures/'.$ecriture->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', ['class' => 'btn', 'onClick' => 'javascript:return(confirmation());']) }}
{{ Form::close() }}

<p>Créée le {{ F::dateCourteNb($ecriture->created_at) }}<br />
	Modifiée le {{ F::dateCourteNb($ecriture->updated_at) }}</p>
@stop

@section('compta/footer')
@parent
<h3>  Le footer de édition d'écritures</h3>
@stop