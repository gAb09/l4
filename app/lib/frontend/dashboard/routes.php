<?php
/*
|--------------------------------------------------------------------------
| Dashboard / Prefix "dashboard"
|--------------------------------------------------------------------------*/

Route::group(array('prefix' => 'dashboard', 'before' => ['auth', 'user']), function() 
{
	Route::get('/', function(){
		return Redirect::to('dashboard/moncompte');
	});

	Route::get('moncompte', function()
	{
		return View::make('frontend.dashboard.moncompte')
		->with('titre_page', 'Mon compte')
		;
	});

	Route::get('update_moncompte', function()
	{
		return View::make('frontend/dashboard.update_moncompte')
		->with('titre_page', 'Modifier mon compte')
		;
	});

	Route::get('update_mon_mdp', function()
	{
		return View::make('frontend/dashboard.update_mon_mdp')
		->with('titre_page', 'Modifier mon mot de passe')
		;
	});

	Route::put('user/mdp/{id?}', 'UtilisateurController@updatemdp');

});  // Fin de groupe Prefix "dashboard"
