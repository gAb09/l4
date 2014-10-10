<?php

class PointageController extends BaseController {

	// Les statuts accessibles (séparés par un "-")
	private $statuts_accessibles = '2-3-4';

	private $repo = '';


	public function __construct(){
		$this->repo = new PointageRepo;
	}

	public function index($id = 1) // $id = 1 compte principal par défaut
	{
		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		// Récupérer la collection d'écriture pour la banque demandée
		$ecritures = $this->repo ->Pointage($id);


		/* S'il n'y a pas d'écriture pour la banque demandée : 
		rediriger sur la page pointage par défaut avec un message d'erreur */
		if (!$ecritures){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= Banque::find($id)->nom;
			$message .= '”';
			return Redirect::back()->withErrors($message);
		}


		// Initialiser les variables $prev_mois et $solde.
		$prev_mois = 0;
		$solde = 0;

		// Passer le nom et l’id de la banque à la session pour mémorisation de la banque en cours de traitement. 
		Session::put('Etat.banque', $ecritures[0]->banque->nom);
		Session::put('Etat.banque_id', $ecritures[0]->banque->id);

		// Assigner le tableau de correspondance. 
		Session::put('Etat.banque', $ecritures[0]->banque->nom);
		Session::put('Etat.banque_id', $ecritures[0]->banque->id);

		// Afficher la vue pointage pour la banque demandée. 
		return View::make('frontend.tresorerie.views.pointage.main')
		->with('ecritures', $ecritures)
		->with(compact('prev_mois'))
		->with(compact('solde'))
		->with(array('statuts_accessibles' => $this->statuts_accessibles))
		->with(array('classe_statut_selon_id' => Statut::classe_statut_selon_id()))
		;

	}

	public function incrementeStatut($id, $statuts_accessibles)
	{
		// return 'pointage de l’écriture n° '.$id.'<br />Statut id : '.$statut_id;  // CTRL
		// return var_dump(Input::all());  // CTRL

		$ecriture = Ecriture::find($id);

		$ecriture->statut_id = Statut::incremente($statuts_accessibles, $ecriture);

		// return var_dump($new_statut); // CTRL

		$ecriture->save();

		return Response::make('', 204);
	}


}
