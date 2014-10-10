<?php
use lib\shared\Traits\ModelTrait;

class Statut extends Eloquent {
	use ModelTrait;

	protected static $unguarded = true; // AFA

	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}

	protected static $default_values_for_create = [
		'nom' => 'rehja,ea',
		'classe' => 'Saisir un libellé',
		'description' => 'Éventuellement le compléter',
		];

	/* —————————  Validation : règles et messages  —————————————————*/

	public static function StoreRules(){
		// $rules = array(
		// 	'nom' => 'unique:banques,nom|required|not_in:CREATE_FORM_DEFAUT_TXT_NOM',
		// 	'description' => 'not_in:CREATE_FORM_DEFAUT_TXT_DESCRIPTION', // inférieure à 500 caractères
		// 	);
		// return $rules;
	}

	public static function UpdateRules(){
		// $rules = array(
		// 	'nom' => 'required|not_in:CREATE_FORM_DEFAUT_TXT_NOM',
		// 	'description' => 'not_in:CREATE_FORM_DEFAUT_TXT_DESCRIPTION',
		// 	);
		// return $rules;
	}

	public static function Messages(){
		$messages = array(
		// 	'nom.unique' => 'Il existe déjà une banque portant ce nom.',
		// 	'nom.not_in' => 'Oups… Vous n’avez rien saisi de nouveau dans le champs :attribute !',
		// 	'description.not_in' => 'Il vaut mieux, soit laisser le champs :attribute vide, soit y saisir une description.',
			);
		return $messages;
	}



	public static function incremente($statuts_accessibles, $ecriture)
	{
		$last_statut_accessible = substr($statuts_accessibles, -1);
		$statut_actuel = ($ecriture->statut_id);

		$new_statut = ($statut_actuel < $last_statut_accessible) ? ++$statut_actuel : $statuts_accessibles[0] ;

		return $new_statut;
	}

	public static function classe_statut_selon_id(){
		$results = Statut::all(['id', 'classe']);
		foreach ($results as $result) {
			$classe_statut_selon_id[$result->id] = $result->classe;
		}
		return json_encode($classe_statut_selon_id);
	}

	/* —————————  ACCESSORS  —————————————————*/


	/* —————————  MUTATORS  —————————————————*/


}