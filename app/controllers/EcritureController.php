<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;


class EcritureController extends BaseController {

	public function index($banque = null)
	{
		Session::put('page_depart', Request::path());

		if ($banque === null) {
			$ecritures = Ecriture::all();
		}else{
			$ecritures = Ecriture::whereBanqueId($banque)->get();
		// return var_dump($ecritures);  // CTRL
		}
		return View::Make('compta/ecritures/index')->with(compact('ecritures'));
	}



	public function create()
	{
		// return 'Formulaire pour la création d\'une ecriture';  // CTRL

		$mode_emploi = Ecriture::fillFormForCreate();  // AFa Revoir les form:model

		return View::Make('compta/ecritures/create')->with('ecriture', $mode_emploi);
	}



	public function store()
	{
		// return 'Enregistrement d\'une nouvelle ecriture“';  // CTRL
		 // dd(Input::all()); 

		/* Instancier écriture 1 */
		$ec1 = new Ecriture;

		/* Si écriture simple */
		if (!Input::get('double_flag')) {

			$ec1 = static::hydrateSimple($ec1);

			$ec1->save();

		}else{
			/* Si écriture double */

			$couple = static::hydrateDouble($ec1, $ec2 = null);
			$ec1 = $couple[0];
			$ec2 = $couple[1];

			$ec1->save();

		// /* double_id */
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
		/* Instancier écriture 2 */
		if ($ec2 === null) {
			$ec2 = new Ecriture;
		}

		/* banque */
		$ec1->banque_id = Input::get('banque_id');
		$ec2->banque_id = Input::get('banque2_id');

		/* date émission */
		$ec1->date_emission = $ec2->date_emission = F::dateSaisieSauv(Input::get('date_emission'));

		/* date valeur */
		$ec1->date_valeur = $ec2->date_valeur = F::dateSaisieSauv(Input::get('date_valeur'));

		/* montant */
		$ec1->montant = $ec2->montant = Input::get('montant');

		/* signe */
		$ec1->signe_id = Input::get('signe_id');
		$ec2->signe_id = ($ec1->signe_id == 1)? 2 : 1;

		/* libellé */
		$ec1->libelle = $ec2->libelle = Input::get('libelle');

		/* libellé détail */
		$ec1->libelle_detail = $ec2->libelle_detail = Input::get('libelle_detail');

		/* type */
		$ec1->type_id = Input::get('type_id');
		$ec2->type_id = Input::get('type2_id');

		/* justificatif */
		$ec1->justificatif = Input::get('justificatif');
		$ec2->justificatif = Input::get('justif2');

		/* compte */
		$ec1->compte_id = $ec2->compte_id = Input::get('compte_id');

		/* double flag */
		$ec1->double_flag = $ec2->double_flag = Input::get('double_flag');

		return array($ec1, $ec2);

	}




	public function edit($id)
	{
		// return 'edition de l\écriture n° '.$id;  // CTRL
		try{
			$ec1 = Ecriture::where('id', '=', $id)->with('ecriture2')->get();
		}
		catch (ModelNotFoundException $e)
		{
			return (Response::make('L’écriture '.$id.' est introuvable', 404));
		}

		return View::Make('compta/ecritures/edit')->with('ecriture', $ec1[0]);
	}



	public function update($id)
	{
		/* Instancier ecriture 1 */
		$ec1 = Ecriture::where('id', '=', $id)->with('ecriture2')->first();

		/* Nommage de l'écriture n°1 compréhensible par l’utilisateur */
		$nommage = ($ec1->double_flag == 1) ? 'principale ' : '' ;

		/* Initialiser la variable destinée à contenir le message de succès */
		$success = '';

		/* Détecter si changement du flag double écriture */
		$doubleBefore = $ec1->double_flag;
		$doubleNow = (Input::get('double_flag'));
		$changement = ($doubleBefore != $doubleNow) ? true : false ;

		// var_dump($doubleBefore); // CTRL
		// var_dump($doubleNow); // CTRL
		// dd($changement); // CTRL

		/* - - - - - - - - - - - - - - - - - - - - - -
		Déterminer si la requete vient du form avec ou sans confirmation
		- - - - - - - - - - - - - - - - - - - - - - - -
		S'il y a changement de type, on doit alors vérifier qu'il y a eu confirmation.
		Si pas de segment 4 => non confirmé. */
		if($changement == 1 and Request::segment(4) != 'ok'){
			Input::flash();

			/*	- stopper le processus,
				- présenter un nouveau formulaire identique du point de vue des inputs, et qui
		 	  		• conserve les entrées faites par l'utilisateur,
		 	    	• modifie l'action du formulaire (ajout de "/ok" en fin d'url) afin de ne pas être filtré à nouveau,
		 	    	• affiche un message alertant sur le changement de type et donnant la possibilté d'annuler. */

		 	    	/* Le message sera composé différemment selon qu'il s'agit d'un passage d'une écriture double à une écriture simple  ou du passage inverse */
		 	    	if ($doubleBefore){
		 	    		$message = "• Attention ! Vous cherchez à passer d’une écriture double à une écriture simple.<br />• IMPORTANT : Notez bien que c’est l’écriture actuellement ouverte qui sera conservée et l’écriture liée va être automatiquement supprimée.<br />Vous pouvez :<br /> – Faire vos modifications éventuelles et cliquer sur le bouton “Enregistrer”,<br /> – Revenir à la  ";
		 	    	}else{
		 	    		$message = "Attention ! Vous cherchez à passer d’une écriture simple à une écriture double.<br />Si vous êtes sûr de vos modifications vous pouvez cliquer sur le bouton “Enregistrer”.<br />Sinon vous pouvez revenir à la ";

		 	    	}
		 	    	Session::flash('erreur', $message .= link_to(Session::get('page_depart').'#ligne'.$id, 'page précédente'));

		 	    	/* Redirection */
		 	    	return View::make('compta/ecritures/confirmedit')
		 	    	->withInput(Input::get())
		 	    	->with('ecriture', $ec1)
		 	    	->with(compact('type_dble_ecriture'))
		 	    	;
		 	    }

			/* - - - - - - - - - - - - - - - - - - - - - -
			Traitement de l'update (la demande a été confirmée ou bien elle n'en avait pas besoin).  
			- - - - - - - - - - - - - - - - - - - - - - - - */
		   	// dd('Traitement de l’update'); // CTRL


			/* - - - - - - - - - - - - - - - - - - - - - -
			Si l'écriture est de type simple
			- - - - - - - - - - - - - - - - - - - - - - - - */
			if (!$doubleNow == 1)
			{
				/* Hydrater ecriture 1 avec les nouvelles entrées*/
				$ec1 = static::hydrateSimple($ec1);

				/* - - - - - - - Si passage d'écriture double à simple - - - - - - - - - - - */
				if ($changement and $doubleBefore == 1) {
		 		// dd('2 en 1'); // CTRL

					/* Supprimer E2 */
					$ec2 = Ecriture::whereDoubleId($ec1->id)->where('id', '!=', $ec1->id)->get();
					$ec2[0]->delete();

					/* Désynchroniser E1 */
					$ec1->double_id = null;

					/* Composer messages */
					$success = "• L’écriture $nommage désynchronisée…<br />• L’écriture liée a été supprimée<br />".$success;
				}


			/* - - - - - - - - - - - - - - - - - - - - - -
			Si l'écriture est de type double…	
			- - - - - - - - - - - - - - - - - - - - - - - - */
		}else{
		 		// var_dump('type double'); // CTRL

				/* - - - - - - - - - - - - - - - - - - - - - -
				… et était simple avant…
				- - - - - - - - - - - - - - - - - - - - - - - - */
				if ($changement) {
			 		// dd('1 en 2');  // CTRL

					/* Instancier E2 */
					$ec2 = new Ecriture();
					$success .= '• L’écriture liée a été créée.<br />';

					/* Synchroniser E2 */
					$ec2->double_id = $id;
					$success .= '• L’écriture liée a été synchronisée.<br />';


				/* - - - - - - - - - - - - - - - - - - - - - -
				… et était déjà double.
				- - - - - - - - - - - - - - - - - - - - - - - - */
			}else{

			 	// dd('2 en 2');  // CTRL

				/* Instancier E2 */
				$ec2 = Ecriture::whereDoubleId($ec1->id)->get();

				// dd($ec2);  // CTRL
				// dd(DB::getQueryLog());

				/* Vérification qu'il n’existe qu'une seule écriture liée */
				if($ec2->count() > 1)
				{
					return Redirect::back()->withErrors('Il y a plus d’une écriture associée à celle qui vient d’être modifiée. <a href"">Contrôle des écritures doubles"</a>');
				}
				$ec2 = $ec2[0];
			}

			/* Hydrater les 2 écritures */
			$couple = static::hydrateDouble($ec1, $ec2);

			/* Save E2 */
			$ec2->save();
			$success .= '• L’écriture liée a été sauvegardée<br />';

			/* Synchroniser E1 */
			if ($changement) {
				$ec1->double_id = $ec2->id;
				$success = "• L’écriture $nommage a été synchronisée.<br />".$success;
			}

		}

		/* - - - - - - - - - - - - - - - - - - - - - -
		Dans tous les cas
		- - - - - - - - - - - - - - - - - - - - - - - - */
 		// dd('type simple'); // CTRL
		/* Save E1 */
		$ec1->save();

		$success = "• L’écriture $nommage a été sauvegardée.<br />".$success;

		/* Rediriger */
		Session::flash('success', $success);
		return Redirect::to(Session::get('page_depart').'#ligne'.$id);
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
			$deuze = Ecriture::whereDoubleId($ecriture->double_id)->where('id', '!=', $ecriture->id)->get();
			// dd($deuze); // CTRL
			$deuze = $deuze[0];
			$deuze->delete();
		}

		return Redirect::to(Session::get('page_depart').'#ligne'.$id);
	}


	public function separateurs($id)
	{
		// return 'effacement désactvé';  // CTRL
		// return 'effacement de l\écriture n° '.$id;  // CTRL

		$ecriture = Ecriture::find($id);
		// dd($ecriture); // CTRL

		$ecriture->delete();

		/* Le cas échéant traiter l'écriture liée */
		if ($ecriture->type->req_banque2){
			$deuze = Ecriture::whereDoubleId($ecriture->double_id)->where('id', '!=', $ecriture->id)->get();
			// dd($deuze); // CTRL
			$deuze = $deuze[0];
			$deuze->delete();
		}

		return Redirect::to(Session::get('page_depart').'#ligne'.$id);
	}
}