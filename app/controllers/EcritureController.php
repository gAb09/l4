<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationEcriture;
use Lib\Validations\ValidationDoubleEcriture;

class EcritureController extends BaseController {

	protected $validateur;

	protected $validateur2;

	/* Attribuer le nom donné à l'écriture n°1 dans les messages (souci de clarté pour l’utilisateur)
	afin de pouvoir le changer globalement on le place dans une variable  */
	private $nommage = 'en cours d’édition';



	public function __construct(ValidationEcriture $validateur, ValidationDoubleEcriture $validateur2)
	{
		$this->validateur = $validateur;
		$this->validateur2 = $validateur2;
	}

	private $listes = array();

	private function lister()
	{
		$this->listes['banque'] = Banque::listForInputSelect('nom');
		$this->listes['compte'] = Compte::listForInputSelect('libelle', 'Actif');
		$this->listes['type'] = Type::listForInputSelect('nom');
		return $this->listes;
	}



	public function index($banque = null)
	{
		Session::put('page_depart', Request::path());

		if ($banque === null) {
			$ecritures = Ecriture::all();
			$titre_page = 'Toutes les écritures';
		}else{
			$bank_nom = Banque::find($banque)->nom;
			$ecritures = Ecriture::whereBanqueId($banque)->get();
			$titre_page = 'Écritures de la banque “'.$bank_nom.'”';
		}
		// S'il n'y a pas d'écriture pour la banque demandée : rediriger sur la page pointage par défaut avec un message d'erreur
		if ($ecritures->isEmpty()){
			$message = 'Il n’y a aucune écriture pour la banque “'.$bank_nom.'”';
			return Redirect::to('compta/ecritures')->withErrors($message);
		}

		return View::Make('compta.ecritures.index')->with(compact('ecritures'))->with(compact('titre_page'));
	}



	public function create()
	{
		$ecriture = new Ecriture;
		$ecriture->fillFormForCreate();

		return View::Make('compta.ecritures.create')
		->with('ecriture', $ecriture)
		->with('list', self::lister())
		;
	}


	public function store()
	{
		/* Instancier écriture 1 */
		$ec1 = new Ecriture;

		/* Si écriture simple */
		if (!Input::get('double_flag')) {

			$ec1 = static::hydrateSimple($ec1);

			$validation = $this->validateur->validate( Input::all() );
			if ($validation === true) {
				$ec1->save();
				Session::flash('success',"L’écriture a été créée");
			}else{
				return Redirect::back()->withInput(Input::all())->withErrors($validation);
			}

		}else{
			/* Si écriture double */ 

			$double = static::hydrateDouble($ec1, $ec2 = null);
			$ec1 = $double[0];
			$ec2 = $double[1];

			$validation = $this->validateur->validate( Input::all() );
			$validation2 = $this->validateur2->validate( Input::all() );

			if ($validation === true) {
				if ($validation2 === true) {
					Session::flash('success',"Les deux écritures ont été créées et synchronisées");
				}else{
					return Redirect::back()->withInput(Input::all())->withErrors($validation2);
				}
			}else{
				return Redirect::back()->withInput(Input::all())->withErrors($validation);
			}

			$ec1->save();

		// /* Synchroniser */
			$ec2->double_id = $ec1->id;
			$ec2->save();

			$ec1->double_id = $ec2->id;
			$ec1->save();
		}
		return Redirect::to(Session::get('page_depart'));

	}

	private static function hydrateSimple(Ecriture $ec1)
	{		
		$ec1->banque_id = Input::get('banque_id');
		$ec1->date_emission = F::dateSaisieSauv(Input::get('date_emission'));
		$ec1->date_valeur = F::dateSaisieSauv(Input::get('date_valeur'));
		$ec1->montant = Input::get('montant');
		$ec1->signe_id = Input::get('signe_id');
		$ec1->libelle = Input::get('libelle');
		$ec1->libelle_detail = Input::get('libelle_detail');
		$ec1->type_id = Input::get('type_id');
		$ec1->justificatif = Input::get('justificatif');
		$ec1->compte_id = Input::get('compte_id');
		$ec1->double_flag = Input::get('double_flag');

		return $ec1;
	}



	private static function hydrateDouble(Ecriture $ec1, Ecriture $ec2 = null)
	{
		/* Hydrater écriture 1 */
		$ec1 = static::hydrateSimple($ec1);

		/* Instancier écriture 2 */
		if ($ec2 === null) { // Store
			$ec2 = new Ecriture;
		}

		/* Hydrater écriture 2 */
		$ec2->banque_id = Input::get('banque2_id');
		$ec2->date_emission = F::dateSaisieSauv(Input::get('date_emission'));
		$ec2->date_valeur = F::dateSaisieSauv(Input::get('date_valeur'));
		$ec2->montant = Input::get('montant');
		$ec2->signe_id = ($ec1->signe_id == 1)? 2 : 1;
		$ec2->libelle = Input::get('libelle');
		$ec2->libelle_detail = Input::get('libelle_detail');
		$ec2->type_id = Input::get('type2_id');
		$ec2->justificatif = Input::get('justif2');
		$ec2->compte_id = Input::get('compte_id');
		$ec2->double_flag = Input::get('double_flag');

		return array($ec1, $ec2);

	}



	public function edit($id)
	{
		$ec1 = Ecriture::where('id', $id)->with('ecriture2')->first();

		return View::Make('compta/ecritures/edit')
		->with('ecriture', $ec1)
		->with('list', self::lister())
		;
	}



	public function update($id)
	{
		/* Instancier ecriture 1 */
		$ec1 = Ecriture::where('id', $id)->with('ecriture2')->first();

		/* Initialiser la variable destinée à contenir le message de succès */
		$success = '';

		/* Détecter si changement du flag double écriture */
		$doubleBefore = ($ec1->double_flag == 1 ? true : false);
		$doubleNow = (is_null(Input::get('double_flag'))) ? false : true;

		$changement = ($doubleBefore != $doubleNow) ? true : false ;

		/* Déterminer si le changement de type est confirmée ou non */
		$confirmOk = (Input::get('verrou') == 1 ) ? false : true ;

		/* Si changement de type, on doit alors vérifier s'il y a eu confirmation. */

		/* Si non confirmé */
		if($changement == true and $confirmOk == false){

			/* Conserver les inputs */
			Input::flash();

		/*	- stopper le processus,
		- présenter un nouveau formulaire identique du point de vue des inputs, et qui
 	  		• conserve les entrées faites par l'utilisateur,
 	    	• modifie l'action du formulaire (ajout de "/ok" en fin d'url) afin de ne pas être filtré à nouveau,
 	    	• affiche un message alertant sur le changement de type et donnant la possibilté d'annuler. */

 	    	/* Le message sera composé différemment selon qu'il s'agit d'un passage d'une écriture double à une écriture simple  ou du passage inverse */
 	    	if ($doubleBefore){
 	    		$message = "• Attention ! Vous demandez à passer d’une écriture double à une écriture simple.<br />• IMPORTANT : Notez bien que c’est l’écriture actuellement ouverte qui sera conservée et l’écriture liée va être automatiquement supprimée.<br />Vous pouvez :<br /> – Vérifier votre saisie et VALIDER ce choix en déverouillant ".VERROU.",<br /> – ANNULER en revenant à la ";
 	    	}else{
 	    		$message = "Attention ! Vous cherchez à passer d’une écriture simple à une écriture double.<br />Vous pouvez :<br /> – Vérifier votre saisie et VALIDER ce choix en déverouillant ".VERROU.",<br /> – ANNULER en revenant à la ";

 	    	}

 	    	Session::flash('erreur', $message .= link_to(Session::get('page_depart').'#ligne'.$id, 'page précédente'));
 	    	Session::flash('class_verrou', 'gfg');
 	    	/* Redirection */
 	    	return Redirect::back()->withInput(Input::all());
 	    }


			/* - - - - - - - - - - - - - - - - - - - - - -
			Traitement de l'update (Pas de changement de type OU BIEN celui-ci a été confirmé).  
			- - - - - - - - - - - - - - - - - - - - - - - - */

			/* - - - - - - - - - - - - - - - - - - - - - -
			Si l'écriture est de type simple
			- - - - - - - - - - - - - - - - - - - - - - - - */
			if (!$doubleNow == 1)
			{
				Session::flash('test.passage', '1 vers 1');
				/* - - - - - - - - - - - - - - - - - - - - - -
				… et était simple avant…
				- - - - - - - - - - - - - - - - - - - - - - - - */
				/* Hydrater ecriture 1 avec les nouvelles entrées*/
				$ec1 = static::hydrateSimple($ec1);

				/* - - - - - - - - - - - - - - - - - - - - - -
				… et était double avant…
				- - - - - - - - - - - - - - - - - - - - - - - - */
				if ($changement and $doubleBefore == 1) {
					Session::flash('test.passage', '2 vers 1');

					/* Supprimer E2 */
					$ec2 = Ecriture::where('id', Input::get('ecriture2_id'))->get();

					$ec2[0]->delete();

					/* Désynchroniser E1 */
					$ec1->double_id = null;

					/* Composer messages */
					$success = "• L’écriture $this->nommage a été désynchronisée…<br />• L’écriture liée a été supprimée<br />".$success;
				}


			/* - - - - - - - - - - - - - - - - - - - - - -
			Si l'écriture est de type double…	
			- - - - - - - - - - - - - - - - - - - - - - - - */
		}else{
				/* - - - - - - - - - - - - - - - - - - - - - -
				… et était simple avant…
				- - - - - - - - - - - - - - - - - - - - - - - - */
				if ($changement) {

					/* Instancier E2 */
					$ec2 = new Ecriture();
					$success .= '• L’écriture liée a été créée.<br />';

					/* Synchroniser E2 */
					$ec2->double_id = $id;
					$success .= '• L’écriture liée a été synchronisée.<br />';


				/* - - - - - - - - - - - - - - - - - - - - - -
				… et était déjà double avant.
				- - - - - - - - - - - - - - - - - - - - - - - - */
			}else{

				/* Instancier E2 */
				$ec2 = Ecriture::where('id', Input::get('ecriture2_id'))->get();

				/* Vérification qu'il n’existe qu'une seule écriture liée */
				if($ec2->count() > 1)
				{
					return Redirect::back()->withErrors('ATTENTION PROBLÈME GRAVE : il y a plus d’une écriture associée à celle qui vient d’être modifiée. Contactez l’administrateur<!-- aFa a href"">Contrôle des écritures doubles"</a-->');
				}
				$ec2 = $ec2[0];
			}

			/* Hydrater les 2 écritures */
			$double = static::hydrateDouble($ec1, $ec2);

			/* Save E2 */
			$validation2 = $this->validateur2->validate( Input::all() );

			if ($validation2 === true) {
				$ec2->save();
				$success .= '• L’écriture liée a été sauvegardée<br />';
			}else{
				return Redirect::back()->withInput(Input::all())->withErrors($validation2);
			}

			/* Synchroniser E1 */
			if ($changement) {
				$ec1->double_id = $ec2->id;
				$success = "• L’écriture $this->nommage a été synchronisée.<br />".$success;
			}

		}

		/* - - - - - - - - - - - - - - - - - - - - - -
		Dans tous les cas
		- - - - - - - - - - - - - - - - - - - - - - - - */
		// dd(Input::all());
		$validation = $this->validateur->validate( Input::all() );

		if ($validation === true) {
			$ec1->save();
			$success = "• L’écriture $this->nommage a été sauvegardée.<br />".$success;
		}else{
			return Redirect::back()->withInput(Input::all())->withErrors($validation);
		}

		/* Rediriger */
		Session::flash('success', $success);
		return Redirect::to(Session::get('page_depart').'#ligne'.$id);

	}



	public function destroy($id)
	{
		$ecriture = Ecriture::where('id', $id)->with('ecriture2')->get();
		$ecriture = $ecriture[0];

		$success = '';
		/* Le cas échéant traiter l'écriture liée */

		if ($ecriture->ecriture2){
			$deuze = Ecriture::whereDoubleId($ecriture->ecriture2->double_id)->get();
			$deuze = $deuze[0];
			$deuze->delete();
			$success = "• La deuxième écriture à été supprimée.<br />";
		}
		$ecriture->delete();
		$success = "• La première écriture à été supprimée.<br />$success";

		Session::flash('success', $success);
		return Redirect::to(Session::get('page_depart').'#ligne'.$id);
	}


}