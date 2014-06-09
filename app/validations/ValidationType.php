<?php namespace Lib\Validations;

class ValidationType extends ValidationBase
{


	protected $rules = array(
		'nom' => 'unique:types,nom|required|not_in:Nom du type d’écriture',
		'description' => 'required|not_in:Saisir ici la description.',
		'sep_justif' => 'required|not_in:Saisir un séparateur',
		);

	public $messages = array(
		'nom.unique' => 'Il existe déjà un type d’écriture portant ce Nom.',
		'nom.not_in' => 'Vous n’avez rien saisi de nouveau dans le champs “Nom”.',
		'description.required' => 'Vous n’avez rien saisi dans le champs “Description”',
		'description.not_in' => 'Vous n’avez rien saisi de nouveau dans le champs “Description”',
		'sep_justif.required' => 'Vous n’avez pas choisi de séparateur.',
		'sep_justif.not_in' => 'Vous n’avez rien saisi de nouveau dans le champs “Séparateur”.',
		);

}
