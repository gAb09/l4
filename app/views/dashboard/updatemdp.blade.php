@extends('compta/layout')

@section('contenu')
<div>
{{ Form::open(['method' => 'put', 'action' => ['UtilisateurController@updatemdp', 'Auth::user()->id'] ] ) }}

	{{ Form::label('password', 'Ancien mot de passe', array ('class' => '')) }}
	{{ Form::text('password', null, array ('class' => '')) }}

	{{ Form::label('newpassword', 'Nouveau mot de passe', array ('class' => '')) }}
	{{ Form::text('newpassword', null, array ('class' => '')) }}

	{{ Form::label('newpasswordconf', 'Confirmation du nouveau mot de passe', array ('class' => '')) }}
	{{ Form::text('newpasswordconf', null, array ('class' => '')) }}

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
</div>
@stop

@section('script')
@stop