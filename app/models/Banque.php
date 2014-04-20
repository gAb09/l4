<?php

class Banque extends Eloquent {

	protected static $unguarded = true; // AFA


	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}


	/* —————————  Liste pour input select  —————————————————*/

	public static function listForInputSelect()
	{
		$list[0] = 'Faire une sélection';
		foreach(static::all() as $banque)
		{
			$list[$banque->id] = $banque->nom;
		}
		return $list;
	}


	/* —————————  Créer un objet Banque pour le formulaire de création  —————————————————*/

	public static function fillFormForCreate()
	{
		$banque = new Banque();
		$strings = [
		'nom' => 'Saisir un nom',
		'description' => 'Saisir une description',
		];
		$banque->fill($strings);
		return $banque;
	}



	/* —————————  Validation : règles et messages  —————————————————*/

	public static function StoreRules(){
		$rules = array(
			'nom' => 'unique:banques,nom|required|not_in:Saisir un nom',
			'description' => 'not_in:Saisir une description', // inférieure à 500 caractères
			);
		return $rules;
	}

	public static function UpdateRules(){
		$rules = array(
			'nom' => 'required|not_in:Saisir un nom',
			'description' => 'not_in:Saisir une description',
			);
		return $rules;
	}

	public static function Messages(){
		$messages = array(
			'nom.unique' => 'Il existe déjà une banque portant ce nom.',
			'nom.not_in' => 'Oups… Vous n’avez rien saisi de nouveau dans le champs :attribute !',
			'description.not_in' => 'Il vaut mieux, soit laisser le champs :attribute vide, soit y saisir une description.',
			);
		return $messages;
	}
}
