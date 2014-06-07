<?php

class Banque extends Eloquent {
	/* Accès au listes pour input select */
	use ModelTrait;

	protected $guarded = array('id'); // AFA
	protected $softDelete = true; // AFA


	protected $default_values_for_create = array(
		'nom' => 'Saisir un nom',
		'description' => 'Saisir une description',
	);


	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}

}
