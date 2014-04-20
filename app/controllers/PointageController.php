<?php

class PointageController extends BaseController {

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
		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut')->where('banque_id', '=', $id)->orderBy('date_valeur')->get();
		// return var_dump($ecritures);  // CTRL


		// S'il n'y a pas d'écriture pour la banque demandée : rediriger sur la page pointage par défaut avec un message d'erreur
		if ($ecritures->isEmpty()){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= Banque::find($id)->nom;
			$message .= '”';
			return Redirect::to('compta/pointage/banque')->withErrors($message);
		}

		// Créer la propriété $date_valeur pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures){
			$ecriture->mois_valeur = F::dateClass($ecriture->date_valeur);
			return $ecritures;
		});

		// Assigner les variables $banque, $prev_mois et $solde
		$prev_mois = 0;
		$banque = $ecritures[0]->banque->nom;
		$solde = 0;

		return View::make('compta/pointage')->with('ecritures', $ecritures)->with(compact('solde'))->with(compact('prev_mois'))->with(compact('banque'));

	}

	public function pointage($id, $statut_id)
	{
		// return 'pointage de l’écriture n° '.$id.'<br />Statut id : '.$statut_id;  // CTRL
		// return var_dump(Input::all());  // CTRL

		$ecriture = Ecriture::find($id);

		$nombre_statuts = count(Statut::all());

		$statut_actuel = ($ecriture->statut_id);

		$new_statut = ($statut_actuel < $nombre_statuts) ? ++$statut_actuel : 1 ;

		$ecriture->statut_id = $new_statut;

		// return var_dump($new_statut); // CTRL

		$ecriture->save();

		return Response::make('', 204);
	}

	// public function pointage($id)
	// {
	// 	return 'pointage n°'.$id;  // CTRL
	// 	// return var_dump(Input::all());  // CTRL

	// 	$ecriture = Ecriture::find($id);

	// 	$pointage = (Input::get('pointage')) ? 1 : 0 ;
	// 	$ecriture->pointage = $pointage;

	// 	$ecriture->save();

	// 	return Response::make('', 204);
	// }

	public function pointageWww($id)
	{
		return 'pointageWww n°'.$id;  // CTRL
		// return var_dump(Input::all());  // CTRL

		$ecriture = Ecriture::find($id);

		$pointage_www = (Input::get('pointage_www')) ? 1 : 0 ;
		$ecriture->pointage_www = $pointage_www;

		$ecriture->save();

		return Response::make('', 204);
	}

}
