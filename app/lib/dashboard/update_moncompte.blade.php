@extends('dashboard/views/layout')

@section('contenu')

<div>
{{ Form::open(['method' => 'put', 'action' => ['UtilisateurController@update', Auth::user()->id] ] ) }}

	{{ Form::label('login', 'Login', array ('class' => '')) }}
	{{ Form::text('login', Auth::user()->login, array ('class' => '')) }}

	{{ Form::label('mail', 'Mail', array ('class' => '')) }}
	{{ Form::text('mail', Auth::user()->mail, array ('class' => '')) }}

	{{ Form::label('accueil', 'Ma page d’accueil', array ('class' => '')) }}
	{{ Form::text('accueil', Auth::user()->accueil, array ('class' => 'input-long')) }}
	<p>
		Saisir l'adresse de la page souhaitée.<br />
		Il est souvent plus simple de faire un copiez/collez depuis la barre d’adresse.
	</p>

	<br />{{ Form::submit('Enregistrer', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
</div>
@stop

@section('script')
@stop