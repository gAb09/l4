@extends('compta/layout')
@section('contenu')

{{ Form::open(['method' => 'post', 'action' => 'UtilisateurController@store']) }}

<div>
	<!-- Login -->
	{{ Form::label('login', 'Login', array ('class' => '')) }}
	{{ Form::text('login', null, array ('class' => '', 'style' => 'width:100px;margin-right:10px')) }}
</div>

<div>
	<!-- Mot de passe -->
	{{ Form::label('mdp', 'Mot de passe', array ('class' => '')) }}
	{{ Form::text('mdp', null, array ('class' => '', 'style' => 'width:100px;margin-right:10px')) }}
</div>

<div>
	<!-- Mail -->
	{{ Form::label('mail', 'Mail', array ('class' => '')) }}
	{{ Form::text('mail', null, array ('class' => '', 'style' => 'width:100px;margin-right:10px')) }}
</div>

{{ Form::submit('Créer', array('class' => 'btn')) }}
{{ Form::close() }}

@stop