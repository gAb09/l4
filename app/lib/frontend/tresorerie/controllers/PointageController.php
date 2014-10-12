<?php // aFa Factoriser code pointage/prev/recdep

class PointageController extends BaseController {

	// Les statuts accessibles (séparés par un "-")
	private $statuts_accessibles = '2-3-4';

	private $ecr_repo = '';
	private $bank_repo = '';
	private $statut_repo = '';


	public function __construct(){
		$this->ecr_repo = new EcritureRepository;
		$this->bank_repo = new BanqueRepository;
		$this->statut_repo = new StatutRepository;
	}

	public function index($id = 1) // $id = 1 compte principal par défaut
	{
		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		// Récupérer la collection d'écriture pour la banque demandée
		$ecritures = $this->ecr_repo->collectionCumulMois($id, 'date_valeur');


		/* S'il n'y a pas d'écriture pour la banque demandée : 
		rediriger sur la page pointage par défaut avec un message d'erreur */
		if (!$ecritures){
			$message = 'Il n’y a aucune écriture pour la banque “';
			$message .= $this->bank_repo->nomBanque($id);
			$message .= '”';
			return Redirect::back()->withErrors($message);
		}

		/* Passer le nom et l’id de la banque à la session 
		pour mémorisation de la banque en cours de traitement. */
		Session::put('Etat.banque', $ecritures[0]->banque->nom);
		Session::put('Etat.banque_id', $ecritures[0]->banque->id);

		// Assigner le tableau de correspondance pour gestion js de l'affichage de l'incrémentation des statuts. 
		$classe_statut_selon_id = $this->statut_repo->classeStatutSelonId();

		// Afficher la vue pointage pour la banque demandée. 
		return View::make('frontend.tresorerie.views.pointage.main')
		->with(compact('ecritures'))
		->with(compact('classe_statut_selon_id'))
		->with(array('statuts_accessibles' => $this->statuts_accessibles))
		->with(array('titre_page' => "Pointage de ".Session::get('Etat.banque')))
		;
	}

	// Afa  Passer dans un helper "pointage"
	public function incrementeStatut($id, $statuts_accessibles)
	{
		// return 'pointage de l’écriture n° '.$id.'<br />Statut id : '.$statut_id;  // CTRL
		// return var_dump(Input::all());  // CTRL

		$ecriture = $this->ecr_repo->find($id);

		$ecriture->statut_id = $this->statut_repo->incremente($statuts_accessibles, $ecriture);

			// return var_dump($new_statut); // CTRL

		$this->ecr_repo->save($ecriture);

		return Response::make('', 204);
	}

}