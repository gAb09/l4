<?php

/*
|--------------------------------------------------------------------------
| Section prefix "backend"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'backend', 'before' => array('auth', 'admin')), function() 
{

	/*----------------------  Utilisateurs  ----------------------------------*/
	Route::resource('user', 'UtilisateurController');
	
});  // Fin de groupe prefix backend
