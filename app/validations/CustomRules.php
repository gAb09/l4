<?php
use Carbon\Carbon;

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

// aFA Créer règle "feuille" (une feuille ne peut avoir d'enfants)
// Validator::extend('feuille', function($field, $value, $params)
// {
// 	if (strlen($value) > 6) {
// 		return false;
// 	}else{return true;}
// });



/* - - - - - - - - - - - ECRITURES - - - - - - - - -  */

Validator::extend('afteremission', function($field, $value, $params)
{
	if ($test = substr_count($value, '-') == 2) {
		$parties = explode('-', $value);
		$valeur = Carbon::createFromDate($parties[2], $parties[1], $parties[0]);
		// dd($valeur);
	}
	if ($test = substr_count(Input::get('date_emission'), '-') == 2) {
		$parties = explode('-', Input::get('date_emission'));
		$emission = Carbon::createFromDate($parties[2], $parties[1], $parties[0]);
		// dd($emission);
	}
	if ($valeur < $emission) {
		return false;
	}else{return true;}
});


Validator::extend('fnumeric', function($field, $value, $params)
{
	$value = F::montantFtoPhp($value);
	if (!is_numeric($value)) {
		return false;
	}else{return true;}
});


Validator::extend('notnull', function($field, $value, $params)
{
	$value = F::montantFtoPhp($value);
	settype($value, 'float');
	if ($value == 0) {
		return false;
	}else{return true;}
});

