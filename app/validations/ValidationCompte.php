<?php namespace Lib\Validations;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Factory;

class ValidationCompte extends ValidationBase
{
	protected $rules = array(
		"numero" => 'required|numeric|not_in:6 chiffres max|unique:comptes,numero,$id|digit', 
		// Si changement sur les règles de cet attribut, penser à le reporter dans la méthode CompteController@update
		'libelle' => 'required|not_in:Saisissez un libellé clair',
		'pere' => 'not_in:Faire une sélection|inclusion',
		/* Afa : Un compte de profondeur > 5 ne peu avooir d'enfant */
		);

	protected $messages = array(
		'numero.numeric' => 'Le champs Numéro ne peut contenir que des chiffres.',
		'numero.not_in' => 'Vous n’avez rien saisi de nouveau dans le champs Numéro.',
		'numero.unique' => 'Il existe déjà un compte avec ce numéro.',
		'numero.digit' => 'Un compte ne peut comporter plus de 6 chiffres.',
		'libelle.not_in' => 'Vous n’avez rien saisi dans le champs “Libellé” !',
		'pere.not_in' => 'Vous n’avez pas désigné de "compte père" pour ce compte !',
		'pere.inclusion' => "Le numéro d’un compte doit inclure celui du compte parent.",
		);

}
