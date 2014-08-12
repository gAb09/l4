<?php namespace Lib\Validations;

class ValidationBanque extends ValidationBase
{

	protected $rules = array(
		'nom' => 'required|not_in:CREATE_FORM_DEFAUT_TXT_NOM',
		'description' => 'required|not_in:CREATE_FORM_DEFAUT_TXT_DESCRIPTION', 
		);

	protected $messages = array(
		'nom.required' => 'Il existe déjà une banque portant ce nom.',
		'nom.unique' => 'Il existe déjà une banque portant ce nom.',
		'nom.not_in' => 'Oups… Vous n’avez rien saisi de nouveau dans le champs :attribute !',
		'description.not_in' => 'Il vaut mieux, soit laisser le champs :attribute vide, soit y saisir une description.',
		);

	public function validerStore($inputs){
		$this->rules['nom'] .= '|unique:banques,nom';
		$this->valider($inputs);
	}

	public function validerUpdate($inputs, $id){
		// var_dump($this->rules); // CTRL
		$this->rules['nom'] .= "|unique:banques,nom,$id";
		$this->valider($inputs);
	}

}
