<?php namespace Lib\Validations;

class ValidationDashboard extends ValidationBase
{
	protected $rules = array(
		'login' => 'required|exists:utilisateurs,login',
		'password' => 'required',
		'newpassword' => 'required',
		'newpasswordconf' => 'required',
		);



	protected $messages = array(
		'login.required' => 'Le champs Login doit être renseigné.',
		'login.exists' => "Ce Login est inconnu.",
		'password.required' => 'Le champs ”Mot de passe” doit être renseigné.',
		'newpassword.required' => 'Le champs ”Nouveau mot de passe” doit être renseigné.',
		'newpasswordconf.required' => 'Le champs ”Confirmation du nouveau mot de passe” doit être renseigné.',
		);

}