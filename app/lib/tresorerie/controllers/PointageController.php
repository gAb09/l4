<?php

class PointageController extends BaseController {


	public function index($banque_id = 1) // $banque_id = 1 compte principal par défaut
	{
		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		// Récupérer la collection d'écriture pour la banque demandée
		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'ecriture2')
		->where('banque_id', $banque_id)
		->orderBy('date_valeur')
		->get();


		// S'il n'y a pas d'écriture pour la banque demandée : rediriger sur la page pointage par défaut avec un message d'erreur
		if ($ecritures->isEmpty()){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= Banque::find($banque_id)->nom;
			$message .= '”';
			return Redirect::back()->withErrors($message);
		}

		// Créer la propriété $date_valeur pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures){
			$ecriture->mois_valeur = Date::classAnMois($ecriture->date_valeur);
			return $ecritures;
		});

		// Pré-assigner les variables $banque, $prev_mois et $solde
		$prev_mois = 0;
		$banque = $ecritures[0]->banque->nom;
		$solde = 0;

		// Le tableau des statuts accessibles
		$statuts = '2-3-4';

		return View::make('tresorerie.views.pointage.main')
		->with('ecritures', $ecritures)
		->with(compact('solde'))
		->with(compact('prev_mois'))
		->with(compact('banque'))
		->with(compact('statuts'))
		;

	}

	public function pointage($id, $statuts)
	{
		// return 'pointage de l’écriture n° '.$id.'<br />Rang : '.$rang;  // CTRL
		// return var_dump(Input::all());  // CTRL


		$ecriture = Ecriture::find($id);
		$statut_actuel = $ecriture->statut_id;

		// Composition du tableau des statuts et extraction des infos pour le traitement
		$statuts = explode('-', $statuts);

		// Vérifier si le statut actuel est autorisé à la modification
		if (in_array($statut_actuel, $statuts)) {
			// Si oui on fait la modif
			$nombre_statuts = count($statuts);
			$statut_depart = array_shift($statuts);
			$statut_fin = array_pop($statuts);


			$new_statut = ($statut_actuel < $statut_fin) ? ++$statut_actuel : $statut_depart ;

			$ecriture->statut_id = $new_statut;

			var_dump($nombre_statuts);var_dump($statut_depart);var_dump($statut_fin);var_dump($new_statut);
		// return var_dump($new_statut); // CTRL

			$ecriture->save();

			return Response::make('', 204);
		} else {
			// Si non retour à la page avec message
			Session::flash('info', 'Il n’est pas possible depuis cette page de modifier le statut d’une écriture qui a le statut “'.$ecriture->statut->nom.'”');              
			return Redirect::back();
		}
	}


}
