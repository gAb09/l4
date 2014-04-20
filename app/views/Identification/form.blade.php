<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>
		Login
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/assets/css/lalocale.css" rel="stylesheet" type="text/css">
	<script src="/assets/js/lalocale.js"></script>

</head>

<body>
		<div class="container">

			@if($errors->all())
			<div class="container messages">
				<div class="alert">
					<ul class="errors">
						@foreach($errors->all() as $message)
						<li>{{ $message }}</li>
						@endforeach
					</ul>
				</div>
			</div>
			@endif

			@if(Session::get('success'))
			<div class="container messages">
				<div class="alert success">
					{{ Session::get('success') }}
				</div>
			</div>
			@endif


			<section class="login">
<h5>Bienvenue, vous pouvez vous identifiez</h5>

{{ Form::open(array('url' => 'identification', 'method' => 'post')) }}

{{ Form::label('pseudo', 'Pseudo')}}
{{ Form::text('pseudo', 'Saisissez votre pseudo')}}

{{ Form::label('password', 'Mot de passe')}}
{{ Form::password('password')}}
<br />
	{{ Form::submit('Envoyer') }}
	{{ Form::close() }}

			</section>

		</div>
	</body>
	</html>