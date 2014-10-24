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
	<link href="/assets/css/tresorerie.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<script src="/assets/js/tresorerie.js"></script>

</head>





<body @section('body')>
	@show

	<div class="container-fluid">

		<!-- - - - - - - - - - - - - - - - Messages - - - - - - - - - - - - - - -->
			@include('shared/views/messages')



		<header class="row-fluid">


			<!-- - - - - - - - - - - - - - - - MENU SECTIONS - - - - - - - - - - - - - - -->

			<nav class="navbar sections span12">
				@include('shared/views/menuSections')
			</nav>


			<!-- - - - - - - - - - - - - - SOUS MENU - - - - - - - - - - - - - - -->

			<nav class="navbar menus span9">
				@include('shared/views/menus')
			<h5 style="text-align: center">• • • Version test • • • Base de données : {{DB::getDatabaseName()}} • • •</h5>
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
				<span>••• Page départ : {{Session::get('page_depart')}}</span>
				<span>•••</span><span>En cours d'édition : 
				• Banque courante : {{Session::get('Courant.banque')}}
				• Mois courant : {{Date::MoisEdit(Session::get('Courant.mois'))}}
				• Ligne : {{Session::get('Courant.ligne')}}</span>
				<span><br />
					<span>•••</span>Nombre par page : {{Session::get('Courant.nbre_par_page')}}
				<span>•</span>Tri (paramètre) : {{Session::get('Courant.tri')}}
				<span>•</span>Tri (sens) : {{Session::get('Courant.tri_sens')}}</span>
				<span>•••</span>Classe de compte : {{Session::get('Courant.classe')}}</span>
				<span>•••</span></span></p>



	</div>
	@section('script')

	@show
</body>
</html>