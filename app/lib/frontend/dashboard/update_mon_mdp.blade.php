@extends('frontend/views/layout')

@section('contenu')
<div>
{{ Form::open(['method' => 'put', 'action' => ['UtilisateurController@updatemdp', Auth::user()->id] ] ) }}

	{{ Form::label('mdp', 'Ancien mot de passe', array ('class' => '')) }}
	{{ Form::text('mdp', null, array ('class' => '')) }}

	{{ Form::label('new_mdp', 'Nouveau mot de passe', array ('class' => '')) }}
	{{ Form::text('new_mdp', null, array ('class' => '')) }}

	{{ Form::label('new_mdp_conf', 'Confirmation du nouveau mot de passe', array ('class' => '')) }}
	{{ Form::text('new_mdp_conf', null, array ('class' => '')) }}

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
</div>
@stop

@section('script')
@stop