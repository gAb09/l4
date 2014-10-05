<?php

class PointageController extends BaseController {

	// Le tableau des statuts accessibles
	private $statuts_ok = '2-3-4';

	// Le critère de classement
	private $order = 'date_valeur';


	public function index($id = 1) // $id = 1 compte principal par défaut
	{
/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		// Récupérer la collection d'écriture pour la banque demandée
		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'ecriture2')
		->where('banque_id', $id)
		->orderBy($this->order)
		->get();


		// S'il n'y a pas d'écriture pour la banque demandée : rediriger sur la page pointage par défaut avec un message d'erreur
		if ($ecritures->isEmpty()){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= Banque::find($id)->nom;
			$message .= '”';
			return Redirect::back()->withErrors($message);
		}

		// Créer la propriété $date_valeur pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures){
			$ecriture->mois_classement = \Date::classAnMois($ecriture->{$this->order});
			return $ecritures;
		});

		// Assigner les variables $banque, $prev_mois et $solde
		$prev_mois = 0;
		$banque = $ecritures[0]->banque->nom;
		$solde = 0;


		return View::make('frontend.tresorerie.views.pointage.main')
		->with('ecritures', $ecritures)
		->with(compact('solde'))
		->with(compact('prev_mois'))
		->with(compact('banque'))
		->with(array('statuts_ok' => $this->statuts_ok))
		;

	}

	public function pointage($id, $statuts_ok)
	{
		// return 'pointage de l’écriture n° '.$id.'<br />Statut id : '.$statut_id;  // CTRL
		// return var_dump(Input::all());  // CTRL

		$ecriture = Ecriture::find($id);

		$last_statut_accessible = $statuts_accessibles[strlen($statuts_accessibles)-1];
		$statut_actuel = ($ecriture->statut_id);

		$new_statut = ($statut_actuel < $last_statut_accessible) ? ++$statut_actuel : $statuts_accessibles[0] ;

		$ecriture->statut_id = $new_statut;

		// return var_dump($new_statut); // CTRL

		$ecriture->save();

		return Response::make('', 204);
	}


}
