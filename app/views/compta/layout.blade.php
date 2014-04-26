<?php
// $section = Session::get('section'); // aPo Détection du contexte pour Titre page et menus
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>
		@section('titre')
		{{ Menu::where('nom_sys', '=', Request::segment(1))->get()[0]->etiquette }}
		@show

	</title>
	<link rel="shortcut icon" href="/assets/img/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/assets/css/bruno.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<script src="/assets/js/bruno.js"></script>

</head>

<body {{$body}}>

	<div class="container-fluid">
		<!-- Messages d'erreurs -->
		@if($errors->all())
		<div class="alert row-fluid">
			<div class="alert-danger">
				<ul class="errors">
					@foreach($errors->all() as $message)
					<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>
		</div>
		@endif

		<!-- Messages de succès -->
		@if(Session::get('erreur'))
		<div class="alert container messages">
			<div class="alert-danger">
				{{ Session::get('erreur') }}
			</div>
		</div>
		@endif

		@if(Session::get('success'))
		<div class="alert container messages">
			<div class="alert-success">
				{{ Session::get('success') }}
			</div>
		</div>
		@endif


		<div class="row-fluid">

			<div class="span1">
				@include('compta/fenetre_note')
			</div>

			<header class="span11">

				<div class="navbar">
					<!-- MENU SECTION -->
					<nav class="navbar-inner">
						<p class="logo">Site de Bruno</p>
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"></a>
						<div class="nav-collapse collapse">
							<ul class="nav nav-tabs">
								@foreach($sections as $section)
								@if ($section->nom_sys == Request::segment(1))
								<li class ="active">
									@else
									<li>
										@endif
										<a href="{{ URL::to($section->nom_sys) }}"> {{ $section->etiquette }}</a></li>
										@endforeach
									</ul>
								</div>
							</nav>

							<!-- SOUS MENUS -->
							<nav class="navbar-inner">
								<ul class="nav">
									@foreach ($menus as $menu)
									@if ($menu->publication == 1)
									@if ($menu->nom_sys == Request::segment(2))
									<li class ="dropdown active">
										@else
										<li class="dropdown">
											@endif
											<a href={{ URL::to($menu->route) }} >
												{{ $menu->etiquette }}
											</a>
											@if(!$menu->children->isEmpty())
											<ul class="dropdown-menu">
												@foreach ($menu->children as $children)
												@if($children->publication == 1)
												<li>
													<a href={{ URL::to($children->route) }} >
														{{ $children->etiquette }}
													</a>
												</li>
												@endif
												@endforeach
											</ul>
											@endif
										</li>
										@endif
										@endforeach
									</ul>
								</nav>
							</div>

						</header>
					</div>

					<!-- Avant contenu principal (topcontent, 2 zones) -->
					<div class="row-fluid" style="padding-bottom:5px">

						<div class="span5 offset1">
							@yield('topcontent1')
						</div>

						<div class="span6">
							@yield('topcontent2')
						</div> 
					</div>

					<!-- CONTENU PRINCIPAL -->
					<div class="row-fluid">
						<div class="span11 offset1">
							@yield('contenu')
						</div>
					</div>

					<footer id="bas">
						<hr>
						@section('compta/footer')
						© gAb
						@show
					</footer>
				</div>
			</body>
			</html>