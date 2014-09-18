<?php namespace Lib\Validations;

class ValidationUtilisateur extends ValidationBase
{


	protected $rules = array(
		'login' => 'required|unique:utilisateurs,login',
		'mdp' => 'required',
		'mail' => 'required|unique:utilisateurs,mail',
		);

	public $messages = array(
		'login.unique' => 'Ce Login existe déjà',
		'login.required' => 'Saisissez un Login',
		'mdp.required' => 'Saisissez un Mot de Passe',
		'mail.unique' => 'Ce mail existe déjà',
		'mail.required' => 'Saisissez une adresse mail',
		);

}