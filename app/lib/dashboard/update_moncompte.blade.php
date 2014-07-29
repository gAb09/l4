@extends('tresorerie/views/layout')

@section('contenu')

<div>
{{ Form::open(['method' => 'put', 'action' => ['UtilisateurController@update', 'Auth::user()->id'] ] ) }}

	{{ Form::label('login', 'Login', array ('class' => '')) }}
	{{ Form::text('login', Auth::user()->login, array ('class' => '')) }}

	{{ Form::label('mail', 'Mail', array ('class' => '')) }}
	{{ Form::text('mail', Auth::user()->mail, array ('class' => '')) }}

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
</div>
@stop

@section('script')
@stop