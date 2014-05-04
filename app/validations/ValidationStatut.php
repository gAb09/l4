<?php namespace Lib\Validations;

class ValidationStatut extends ValidationBase
{


	protected $rules = array(
		// 'numero' => 'unique:comptes,numero|required|not_in:6 chiffres max',
		// 'libelle' => 'required|not_in:Saisissez un libellé clair', // inférieure à 500 caractères
		);

	public $messages = array(
		// 'numero.unique' => 'Il existe déjà un compte avec ce numéro.',
		// 'libelle.not_in' => 'Oups… Vous n’avez rien saisi de nouveau dans le champs “Libellé” !',
	// 	'description.not_in' => 'Il vaut mieux, soit laisser le champs :attribute vide, soit y saisir une description.',
		);

}