<?php

class RecDepController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index($id = 1)
	{
		// return 'recettes_depenses';  // CTRL

		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::path());

		// Récupérer la collection d'écriture pour la banque demandée
		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'ecriture2')->where('banque_id', $id)->orderBy('date_emission')->get();
		// return var_dump($ecritures);  // CTRL

		// S'il n'y a pas d'écriture pour la banque demandée : rediriger sur la page recdep par défaut avec un message d'erreur
		if ($ecritures->isEmpty()){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= Banque::findOrFail($id)->nom;
			$message .= '”';
			return Redirect::to('compta/recdep')->withErrors($message);
		}

		// Créer la propriété $mois_emission pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures){
			$ecriture->mois_emission = F::dateClass($ecriture->date_emission);
			return $ecritures;
		});

		// Assigner les variables $banque et $prev_mois
		$banque = $ecritures[0]->banque->nom;
		$prev_mois = 0;

		return View::make('compta.recdep.main')->with(compact('ecritures'))->with(compact('prev_mois'))->with(compact('banque'));
	}

}
