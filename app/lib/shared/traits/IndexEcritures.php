<?php
namespace lib\shared\Traits;

use \BaseController;

trait IndexEcritures {

	public function index($id = 1)
	{
		// return dd($this);  // CTRL

		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		\Session::put('page_depart', \Request::getUri());

		// Récupérer la collection d'écriture pour la banque demandée
		$ecritures = \Ecriture::with('signe', 'type', 'banque', 'statut', 'ecriture2')->where('banque_id', $id)->orderBy($this->order)->get();
		// return var_dump($ecritures);  // CTRL

		// S'il n'y a pas d'écriture pour la banque demandée : rediriger sur la page recdep par défaut avec un message d'erreur
		if ($ecritures->isEmpty()){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= Banque::findOrFail($id)->nom;
			$message .= '”';
			return Redirect::to('tresorerie/recdep')->withErrors($message);
		}

		// Créer la propriété $mois_classement pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures){
			$ecriture->mois_classement = \Date::classAnMois($ecriture->{$this->order});
			return $ecritures;
		});

		// Assigner les variables $banque et $prev_mois
		$banque = $ecritures[0]->banque->nom;
		$prev_mois = 0;


		return \View::make($this->view)
		->with(compact('ecritures'))
		->with(compact('prev_mois'))
		->with(compact('banque'))
		->with(array('statuts_ok' => $this->statuts_ok))
		;
	}

}