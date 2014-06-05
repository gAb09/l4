<?php namespace Lib\Validations;

class ValidationBanque extends ValidationBase
{

	protected $rules = array(
		'nom' => 'unique:banques,nom|required|not_in:Saisir un nom',
		'description' => 'not_in:Saisir une description', // inférieure à 500 caractères
		);

	protected $messages = array(
		'nom.unique' => 'Il existe déjà une banque portant ce nom.',
		'nom.not_in' => 'Oups… Vous n’avez rien saisi de nouveau dans le champs :attribute !',
		'description.not_in' => 'Il vaut mieux, soit laisser le champs :attribute vide, soit y saisir une description.',
		);

}