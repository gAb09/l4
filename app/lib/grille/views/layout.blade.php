<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>
		@section('titre')
		{{ isset($titre_page) ? $titre_page : Menu::where('nom_sys', Request::segment(1))->get()[0]->etiquette }}
		@show

	</title>
	<link rel="shortcut icon" href="/assets/img/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/assets/tresorerie/css/tresorerie.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<script src="/assets/tresorerie/js/tresorerie.js"></script>

</head>





<body @section('body')>
	@show
{{ var_dump(Session::get(Courant)) }}
	<div class="container-fluid">

		<!-- - - - - - - - - - - - - - - - Messages - - - - - - - - - - - - - - -->
			@include('shared/views/messages')



		<header class="row-fluid">


			<!-- - - - - - - - - - - - - - - - MENU SECTIONS - - - - - - - - - - - - - - -->

			<nav class="navbar sections span12">
				@include('menus/views/menuSections')
			</nav>


			<!-- - - - - - - - - - - - - - SOUS MENU - - - - - - - - - - - - - - -->

			<nav class="navbar menus span9">
				@include('menus/views/menus')
			</nav>


			<!-- - - - - - - - - - - - - - - - USER / DECONNEXION - - - - - - - - - - - - - - -->

			<div class="span3 user_widget">
				@include('shared/views/user_widget')
			</div>

		</header>

		<!-- - - - - - - - - - - - - - - - TOP CONTENT (2 zones) - - - - - - - - - - - - - - -->


		<div class="row-fluid" style="padding-bottom:5px">

			<div class="span6">
				@yield('topcontent1')
			</div>

			<div class="span6">
				@yield('topcontent2')
			</div> 
		</div>

		<!-- - - - - - - - - - - - - - - - CONTENU - - - - - - - - - - - - - - -->

		<div class="row-fluid">
			<div>
				@yield('contenu')
			</div>
		</div>


		<!-- - - - - - - - - - - - - - - - FOOTER - - - - - - - - - - - - - - -->

		<footer>
			<hr>
			@section('tresorerie/footer')
			© gAb
			@show
		</footer>

		<!-- - - - - - - - - - - - - - - - BARRE COMMANDES (Zapette) - - - - - - - - - - - - - - -->

		<div class="zapette">
			<div class="zapette_actions">
			@yield('zapette')
			</div>
			<p class="zapette_infos">
				• Version 1 - Layout de grille
			</p>

		</div>


	</div>
	@section('script')

	@show
</body>
</html>