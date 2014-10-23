<?php

/*
|--------------------------------------------------------------------------
| Section prefix "backend"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'backend', 'before' => ['auth', 'admin']), function() 
{

	/*----------------------  Utilisateurs  ----------------------------------*/
	Route::resource('user', 'UtilisateurController');
	
});  // Fin de groupe prefix backend
