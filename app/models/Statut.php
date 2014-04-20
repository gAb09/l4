<?php

class Statut extends Eloquent {

	protected static $unguarded = true; // AFA

	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}

	/* —————————  Validation : règles et messages  —————————————————*/

	public static function StoreRules(){
		// $rules = array(
		// 	'nom' => 'unique:banques,nom|required|not_in:Saisir un nom',
		// 	'description' => 'not_in:Saisir une description', // inférieure à 500 caractères
		// 	);
		// return $rules;
	}

	public static function UpdateRules(){
		// $rules = array(
		// 	'nom' => 'required|not_in:Saisir un nom',
		// 	'description' => 'not_in:Saisir une description',
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

	/* —————————  ACCESSORS  —————————————————*/


	/* —————————  MUTATORS  —————————————————*/


	/* —————————  Liste de sélection  —————————————————*/
	public static function fillFormForCreate()
	{
		$statut = new Statut();
		$statut->nom = 'rehja,ea';
		$statut->classe = 'Saisir un libellé';
		$statut->description = 'Éventuellement le compléter';
		return $statut;
	}

}