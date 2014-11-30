<?php

Route::group(array('before' => array('auth', 'admin')), function() 
{

	/*----------------------  Utilisateurs  ----------------------------------*/
	Route::resource('user', 'UtilisateurController');
	
});