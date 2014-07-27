@extends('tresorerie/layout')

@section('titre')
@parent
: les menus - modification

@stop


@section('topcontent1')
		<h1 class="titrepage">Édition de l’item ou du menu “{{ $menu->etiquette }}”</h1>
@stop


@section('topcontent2')
@stop


@section('contenu')

{{ Form::model($menu, ['method' => 'PUT', 'route' => ['admin.menus.update', $menu->id]]) }}

@include('admin/menus/form')

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}

	{{ Form::open(array('url' => 'admin/menus/'.$menu->id, 'method' => 'delete')) }}
{{ Form::submit('Supprimer', ['class' => 'btn btn-danger', 'onClick' => 'javascript:return(confirmation());']) }}
	{{ Form::close() }}

@stop

@section('footer')
@parent
<h3>  Le footer de menus</h3>

@stop