<?php

class Banque extends Eloquent {
	use ModelTrait;

	protected static $unguarded = true; // AFA


	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
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

}
