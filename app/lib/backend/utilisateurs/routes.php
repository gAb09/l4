<?php

/*
|--------------------------------------------------------------------------
| Section prefix "backend"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'backend', 'before' => 'auth'), function() 
{

	/*----------------------  Utilisateurs  ----------------------------------*/
	Route::resource('user', 'UtilisateurController');
	
});  // Fin de groupe prefix backend
