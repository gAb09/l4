@extends('shared/views/layout')

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
{{ Form::model($ecriture, ['name' => 'form', 'method' => 'put', 'route' => ['tresorerie.ecritures.update', $ecriture->id]]) }}



@include('tresorerie/views/ecritures/form')

@section('zapette')
<p>
	{{ link_to(Session::get('page_depart'), 'Retour liste', 
	array('class' => 'btn btn-primary iconesmall list',)); }}
</p>
@stop

<p>
	{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
</p>

{{ Form::open(array('url' => 'tresorerie/ecritures/'.$ecriture->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', ['class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());']) }}
{{ Form::close() }}

<p>Créée le {{ Date::courte($ecriture->created_at) }}<br />
	Modifiée le {{ Date::courte($ecriture->updated_at) }}</p>
	@stop

	@section('tresorerie/footer')
	@parent
	<h3>  Le footer de édition d'écritures</h3>
	@stop