<?php // aFa Factoriser code pointage/prev/recdep

use lib\shared\Traits\IndexEcritures;

class PrevController extends BaseController {

	use IndexEcritures;

	// Le critère de classement
	private $order = 'date_valeur';

	// Le tableau des statuts modifiables depuis cette page
	private $statuts_accessibles = '1-2';

	public function __construct(){
		$this->prevRepo = new PrevRepository;
		$this->banqueRepo = new BanqueRepository;
		$this->statutRepo = new StatutRepository;
	}

	public function index()
	{
		/* Si l'édition d’une écriture est demandée depuis cette page, 
		il faut passer (via la session) à EcritureController@update pour la redirection */
		Session::put('page_depart', Request::getUri());

		// Récupérer la collection d'écriture
		$ecritures = $this->prevRepo->collectionPrev();


		// Assigner le tableau de correspondance pour gestion js de l'affichage de l'incrémentation des statuts. 
		$classe_statut_selon_id = $this->statutRepo->classeStatutSelonId();

		/* Afficher la vue prévisionnel */ 
		return View::make('frontend.tresorerie.views.prev.main')
		->with(compact('ecritures'))
		->with(compact('classe_statut_selon_id'))
		->with(array('statuts_accessibles' => $this->statuts_accessibles)) 
		->with(array('titre_page' => "Prévisionnel"))
		;
	}

}