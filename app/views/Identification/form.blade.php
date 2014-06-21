<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Identification</title>
	<link rel="shortcut icon" href="/assets/img/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/assets/css/tresorerie.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<script src="/assets/js/tresorerie.js"></script>

</head>

<body>

<div class="container-fluid">
	<!-- Messages d'erreurs -->
	@if($errors->all())
	<div class="alert-danger">
		<ul class="errors">
			@foreach($errors->all() as $message)
			<li>{{ $message }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<!-- Messages de succès -->
	@if(Session::get('erreur'))
	<div class="alert-danger">
		{{ Session::get('erreur') }}
	</div>
	@endif

	@if(Session::get('success'))
	<div class="alert-success">
		{{ Session::get('success') }}
	</div>
	@endif
@if(isset(Auth::user()->login))
{{ Auth::user()->login }}
@endif

	<div class="login">
		<h2>Bienvenue, vous pouvez vous identifiez</h2>
		<div style="margin-left: 155px">
			{{ Form::open(array('action' => 'IdentificationController@identification', 'method' => 'post')) }}

			{{ Form::label('login', 'Login')}}
			{{ Form::text('login', 'Saisissez votre Login')}}

			{{ Form::label('password', 'Mot de passe')}}
			{{ Form::password('password')}}
			<br />
			{{ Form::submit('Envoyer') }}
			{{ Form::close() }}
		</div>
	</div>
</body>
</html>