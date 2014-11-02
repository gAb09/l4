<?php

class PrevController extends BaseController {

	// Le critère de classement
	private $order = 'date_valeur';

	// Le tableau des statuts modifiables depuis cette page
	private $statuts_accessibles = '1-2';

	public function __construct(){
		$this->prevRepo = new PrevRepository;
		$this->banqueRepo = new BanqueRepository;
		$this->statutRepo = new StatutRepository;
	}

	public function index($annee = null)
	{
		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		$banques = $this->banqueRepo->isPrevisionnel();

		// Récupérer la collection d'écriture
		$ecritures = $this->prevRepo->collectionPrev($banques, $annee);

		/* S'il n'y a pas d'écriture pour la banque demandée : 
		rediriger sur la page pointage par défaut avec un message d'erreur */
		if (!$ecritures){
			$message = 'Il n’y a aucune écriture pour l’année “';
			$message .= $annee;
			$message .= '”';
			return Redirect::back()->withErrors($message);
		}

		// Assigner le tableau de correspondance pour gestion js de l'affichage de l'incrémentation des statuts. 
		$classe_statut_selon_id = $this->statutRepo->classeStatutSelonId();

		/* Afficher la vue prévisionnel */ 
		return View::make('frontend.tresorerie.views.prev.main')
		->with(compact('banques'))
		->with(compact('ecritures'))
		->with(compact('classe_statut_selon_id'))
		->with(array('statuts_accessibles' => $this->statuts_accessibles)) 
		->with(array('titre_page' => "Prévisionnel"))
		;
	}

}