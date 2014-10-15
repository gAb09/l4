<?php // aFa Factoriser code pointage/prev/recdep

use lib\shared\Traits\IndexEcritures;

class PrevController extends BaseController {

	use IndexEcritures;

	// Le critère de classement
	private $order = 'date_valeur';

	// Le tableau des statuts modifiables depuis cette page
	private $statuts_accessibles = '1-2';


	private $ecr_repo = '';
	private $bank_repo = '';
	private $statut_repo = '';


	public function __construct(){
		$this->ecr_repo = new EcritureRepository;
		$this->bank_repo = new BanqueRepository;
		$this->statut_repo = new StatutRepository;
	}

	public function index()
	{
		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		// Récupérer la collection d'écriture
		$ecritures = $this->ecr_repo->collectionPrev();


		// Assigner le tableau de correspondance pour gestion js de l'affichage de l'incrémentation des statuts. 
		$classe_statut_selon_id = $this->statut_repo->classeStatutSelonId();

		/* Afficher la vue prévisionnel */ 
		return View::make('frontend.tresorerie.views.prev.main')
		->with(compact('ecritures'))
		->with(compact('classe_statut_selon_id'))
		->with(array('statuts_accessibles' => $this->statuts_accessibles)) 
		->with(array('titre_page' => "Prévisionnel"))
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