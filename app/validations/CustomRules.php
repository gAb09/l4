<?php

/* - - - - - - - - - - - COMPTES - - - - - - - - -  */
Validator::extend('inclusion', function($field, $value, $params)
{
	// Assigner le numéro du compte Père sélectionné
	$pere =  Compte::find($value);
	$num_pere = $pere->numero;

	// Assigner le numéro saisi pour le compte enfant 
	$num_enfant = Input::get('numero');

	// La règle :
	if (strpos($num_enfant, $num_pere) === false) {
		return false;
	}else{return true;}
});

Validator::extend('digit', function($field, $value, $params)
{
	if (strlen($value) > 6) {
		return false;
	}else{return true;}
});

/* - - - - - - - - - - - ECRITURES - - - - - - - - -  */
Validator::extend('afteremission', function($field, $value, $params)
{
	if ($value <= Input::get('date_emission')) {
		return false;
	}else{return true;}
});

Validator::extend('fnumeric', function($field, $value, $params)
{
	$value = F::dateFtoPhp($value);
	if (!is_numeric($value)) {
		return false;
	}else{return true;}
});

Validator::extend('notnull', function($field, $value, $params)
{
	$value = F::dateFtoPhp($value);
	settype($value, 'float');
	if ($value == 0) {
		return false;
	}else{return true;}
});

