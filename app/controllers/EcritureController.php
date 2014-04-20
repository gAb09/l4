<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;


class EcritureController extends BaseController {

	public function index()
	{
		Session::put('page_depart', Request::path());

		$ecritures = Ecriture::all();
		// return var_dump($ecritures);  // CTRL
		
		return View::Make('compta/ecritures/index')->with(compact('ecritures'))->with(compact('mutatorCache'));
	}



	public function create()
	{
		// return 'Formulaire pour la création d\'une ecriture';  // CTRL

		$mode_emploi = Ecriture::fillFormForCreate();  // AFa Revoir les form:model

		/* Créer la liste des types qui impliquent une double écriture */ // aFa Factoriser
		$type_dble_ecriture = Type::type_dble_ecriture();

		return View::Make('compta/ecritures/create')->with('ecriture', $mode_emploi)->with('type_dble_ecriture', $type_dble_ecriture);
	}



	public function store()
	{
		// return 'Enregistrement d\'une nouvelle ecriture“';  // CTRL
		// return var_dump(Input::all()); // CTRL

		/* Créer la liste des types qui impliquent une double écriture */ // aFa Factoriser pour toutes les actions
		$type_dble_ecriture = Type::type_dble_ecriture();

		$ecriture = Ecriture::create(array(
			'date_emission' => F::dateSaisieSauv(Input::get('date_emission')),
			'date_valeur' => F::dateSaisieSauv(Input::get('date_valeur')),
			'montant' => Input::get('montant'),
			'signe_id' => Input::get('signe_id'),
			'libelle' => Input::get('libelle'),
			'libelle_detail' => Input::get('libelle_detail'),
			'banque_id' => Input::get('banque_id'),
			'banque2_id' => Input::get('banque2_id'),
			'type_id' => Input::get('type_id'),
			'type_justif' => Input::get('type_justif'),
			'compte_id' => Input::get('compte_id'),
			));

		/* Le cas échéant traiter l'écriture liée */
		if (in_array(Input::get('type_id'), $type_dble_ecriture)) {

			/* Renseigner le champs "double_ecriture" de la première écriture */

			$ecriture->double_ecriture = $ecriture->id;
			$ecriture->save();


			$symetric_data = static::SymetricData();

			Ecriture::create(array(
				'date_emission' => F::dateSaisieSauv(Input::get('date_emission')),
				'date_valeur' => F::dateSaisieSauv(Input::get('date_valeur')),
				'montant' => Input::get('montant'),
				'signe_id' => $symetric_data['signe'],
				'libelle' => Input::get('libelle'),
				'libelle_detail' => Input::get('libelle_detail'),
				'banque_id' => $symetric_data['banque'],
				'banque2_id' => $symetric_data['banque2'],
				'type_id' => Input::get('type_id'),
				'type_justif' => Input::get('type_justif'),
				'compte_id' => Input::get('compte_id'),
				'double_ecriture' => $ecriture->id,
				));

		}

		return Redirect::to(Session::get('page_depart'));
	}

	public function edit($id)
	{
		// return 'edition de l\écriture n° '.$id;  // CTRL
		try{
			$ecriture = Ecriture::findOrFail($id);
		// return var_dump($ecriture);
		}
		catch (ModelNotFoundException $e)
		{
			return (Response::make('L’écriture '.$id.' est introuvable', 404));
		}

		/* Créer la liste des types qui impliquent une double écriture */ // aFa Factoriser
		$type_dble_ecriture = Type::type_dble_ecriture();

		return View::Make('compta/ecritures/edit')->with('ecriture', $ecriture)->with('conf','')->with(compact('type_dble_ecriture'));
	}



	public function update($id)
	{
		/* Instancier ecriture 1 */
		$ec1 = Ecriture::find($id);

		$success = '';

		/* Créer la liste des types qui impliquent une double écriture */ // aFa Factoriser pour toutes les actions
		$type_dble_ecriture = Type::type_dble_ecriture();

		/* Déterminer l'appartenance au tableau des écritures doubles 
		/* avant modification de l'écriture */
		$old_in_array = in_array($ec1->type->id, $type_dble_ecriture);
		/* après modification de l'écriture */
		$new_in_array = in_array(Input::get('type_id'), $type_dble_ecriture);


		/* Comparer les deux valeurs */
		$changement = ($old_in_array != $new_in_array) ? true : false ;


		/* - - - - - - - - - - - - - - - - - - - - - -
		Déterminer si la requete vient du form avec ou sans confirmation
		- - - - - - - - - - - - - - - - - - - - - - - -
		Si pas de segment 4 => pas confirmation, on doit alors vérifier s'il n'y a pas changement de type */
		  // dd(Request::segment(4));  // CTRL  
		if(Request::segment(4) != 'ok'){
			Input::flash();

			/* Si le type est différent */
			if($changement){
				/*
				- stopper le processus,
				- présenter un nouveau formulaire identique du point de vue des inputs, et qui
		 	  		• conserve les entrées faites par l'utilisateur,
		 	    	• modifie l'action du formulaire (ajout de "/ok" en fin d'url) afin de ne pas être filtré à nouveau,
		 	    	• affiche un message alertant sur le changement de type et donnant la possibilté d'annuler. */

		 	    	/* Le message sera composé différemment selon qu'il s'agit d'un passage d'une écriture double à une écriture simple  ou du passage inverse */
		 	    	if ($old_in_array){
		 	    		$message = "Attention ! Vous cherchez à passer d’une écriture double à une écriture simple.<br />Si vous êtes sûr de votre choix vous pouvez enregistrer. L’écriture liée va être automatiquement supprimée.  Sinon vous pouvez ";
		 	    		$message .= link_to(Session::get('page_depart').'#ligne'.$id, 'Annuler');
		 	    	}else{
		 	    		$message = "Attention ! Vous cherchez à passer d’une écriture simple à une écriture double.<br />Si vous êtes sûr de vos modifications vous pouvez enregistrer. Sinon vous pouvez ";
		 	    		$message .= link_to(Session::get('page_depart').'#ligne'.$id, 'Annuler');

		 	    	}
		 	    	Session::flash('erreur', $message);

		 	    	/* Redirection */
		 	    	return View::make('compta/ecritures/confirmedit')
		 	    	->withInput(Input::get())
		 	    	->with('ecriture', $ec1)
		 	    	->with(compact('type_dble_ecriture'))
		 	    	;
		 	    }
		 	}

			/* - - - - - - - - - - - - - - - - - - - - - -
			Traitement de l'update (l'action a été confirmée ou bien elle n'en avait pas besoin).  
			- - - - - - - - - - - - - - - - - - - - - - - - */
		   	// dd('Traitement de l’update'); // CTRL


			/* Hydrater ecriture 1 avec les nouvelles entrées*/
			$ec1->date_emission = F::dateSaisieSauv(Input::get('date_emission'));
			$ec1->date_valeur = F::dateSaisieSauv(Input::get('date_valeur'));
			$ec1->libelle = Input::get('libelle');
			$ec1->libelle_detail = Input::get('libelle_detail');
			$ec1->banque_id = Input::get('banque_id');
			$ec1->signe_id = Input::get('signe_id');
			$ec1->montant = Input::get('montant');
			$ec1->type_id = Input::get('type_id');
			$ec1->type_justif = Input::get('type_justif');
			if (Input::get('banque2_id')) {
				$ec1->banque2_id = Input::get('banque2_id');
			}
			$ec1->compte_id = Input::get('compte_id');


			/* - - - - - - - - - - - - - - - - - - - - - -
			Si passage d'écriture double à simple 
			- - - - - - - - - - - - - - - - - - - - - - - - */
			if ($changement and !$new_in_array) {
		 		// dd('2 en 1'); // CTRL

				/* Supprimer E2 */
				$ec2 = Ecriture::whereDoubleEcriture($ec1->double_ecriture)->where('id', '!=', $ec1->id)->get();
				$ec2[0]->delete();

				/* Désynchroniser E1 */
				$ec1->double_ecriture = null;

				/* Passer E1->banque2_id à NULL */
				$ec1->banque2_id = null;

				/* Composer messages */
				$success .= 'L’écriture liée a été supprimée<br />L’écriture initiale désynchronisée…';
			}



			/* - - - - - - - - - - - - - - - - - - - - - -
			Si l'écriture est d'un type double
			- - - - - - - - - - - - - - - - - - - - - - - - */
			if ($new_in_array) {
		 		// dd('type double'); // CTRL

				/* - - - - - - - - - - - - - - - - - - - - - -
				Si passage d'écriture simple à double
				- - - - - - - - - - - - - - - - - - - - - - - - */
				if ($changement) {
			 		// dd('1 en 2');  // CTRL

					/* Instancier E2 */
					$ec2 = new Ecriture();
					$success .= 'L’écriture liée a été créée.';
				}else{
				/* - - - - - - - - - - - - - - - - - - - - - -
				Si écriture était déjà double
				- - - - - - - - - - - - - - - - - - - - - - - - */

				/* Instancier E2 */
				/* Vérification qu'il n’existe qu'une seule écriture liée */
				$ec2 = Ecriture::whereDoubleEcriture($ec1->double_ecriture)->where('id', '!=', $ec1->id)->get();

					// dd($ec2);  // CTRL
				// dd(DB::getQueryLog());

				if($ec2->count() > 1)
				{
					return Redirect::back()->withErrors('Il y a plus d’une écriture associée à celle qui vient d’être modifiée. <a href"">Contrôle des écritures doubles"</a>');
				}
				$ec2 = $ec2[0];
			}

			/* Hydrater E2 */
		 		// dd('hydrate E2');
			$symetric_data = static::SymetricData();

			$ec2->date_emission = F::dateSaisieSauv(Input::get('date_emission'));
			$ec2->date_valeur = F::dateSaisieSauv(Input::get('date_valeur'));
			$ec2->libelle = Input::get('libelle');
			$ec2->libelle_detail = Input::get('libelle_detail');
			$ec2->banque_id = $symetric_data['banque'];
			$ec2->signe_id = $symetric_data['signe'];
			$ec2->montant = Input::get('montant');
			$ec2->type_id = Input::get('type_id');
			$ec2->type_justif = Input::get('type_justif');
			$ec2->banque2_id = $symetric_data['banque2'];
			$ec2->compte_id = Input::get('compte_id');

			/* Synchroniser E1 et E2 */
			$ec2->double_ecriture = $ec1->double_ecriture = $ec1->id;

			/* Save E2 */
			$ec2->save();
			$success .= '<br />L’écriture liée a été sauvegardée';

			/* Composer messages */
			$success .= '<br />Les deux écritures sont synchronisées.';
		}


		/* - - - - - - - - - - - - - - - - - - - - - -
		Dans tous les cas
		- - - - - - - - - - - - - - - - - - - - - - - - */
 		// dd('type simple'); // CTRL
		/* Save E1 */
		$ec1->save();

		/* Composer messages */
		$success .= '<br />L’écriture initiale a bien été sauvegardée.';
		Session::flash('success', $success);

		/* Rediriger */
		return Redirect::to(Session::get('page_depart').'#ligne'.$id);
	}


	private static function SymetricData(){
		$ec2['signe'] = (Input::get('signe_id') == 1)? 2 : 1;
		$ec2['banque'] = Input::get('banque2_id');
		$ec2['banque2'] = Input::get('banque_id');
		return $ec2;
	}



	public function destroy($id)
	{
		// return 'effacement désactvé';  // CTRL
		// return 'effacement de l\écriture n° '.$id;  // CTRL

		$ecriture = Ecriture::find($id);
		// dd($ecriture); // CTRL

		$ecriture->delete();

		/* Le cas échéant traiter l'écriture liée */
		if ($ecriture->type->req_banque2){
			$deuze = Ecriture::whereDoubleEcriture($ecriture->double_ecriture)->where('id', '!=', $ecriture->id)->get();
			// dd($deuze); // CTRL
			$deuze = $deuze[0];
			$deuze->delete();
		}

		return Redirect::to(Session::get('page_depart').'#ligne'.$id);
	}
}