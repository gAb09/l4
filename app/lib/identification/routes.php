<?php

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------*/

Route::get('login', array('as' => 'login', function()
{
	// return 'login';
	return View::make('identification/views/form')
	->with('titre_page', 'Identification')
	;
}));

Route::post('identification', 'IdentificationController@identification');

Route::get('deconnexion', array('as' => 'deconnexion', 'uses' => 'DashboardController@deconnexion'));

