<?php namespace Lib\Validations;

class ValidationUtilisateur extends ValidationBase
{
	private $rules = array(
		'pseudo' => 'required',
		'password' => 'required',
		'pseudo' => 'exists:utilisateurs,pseudo',
		);



	private $messages = array(
		'pseudo.required' => 'Le champs “Pseudo” doit être renseigné.',
		'pseudo.exists' => "Le Pseudo “Input::get('pseudo')” est inconnu.",
		'password.required' => 'Le champs ”Mot de passe” doit être renseigné.',
		);

}