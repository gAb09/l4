<?php

class Banque extends Eloquent {
	/* Accès au listes pour input select */
	use ModelTrait;

	protected $guarded = array('id'); // AFA
	protected $softDelete = true; // AFA


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
