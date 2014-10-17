<?php


// Pour importer et/ou modifier import fichier compte .ods
// Route::get('tresorerie/trans', function()
// {
// 	return ComptesOldController::trans();
// });

Route::get('php', function()
{
	return var_dump(phpinfo());
});


/*
|--------------------------------------------------------------------------
| Route racine
|--------------------------------------------------------------------------*/
Route::get('/', function()
{
	return Redirect::route('journal');
});


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

/*
|--------------------------------------------------------------------------
| Dashboard / Prefix "dashboard"
|--------------------------------------------------------------------------*/

Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function() 
{
	Route::get('/', function(){
		return Redirect::to('dashboard/moncompte');
	});

	Route::get('deconnexion', array('as' => 'deconnexion', 'uses' => 'DashboardController@deconnexion'));

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

/*
|--------------------------------------------------------------------------
| Section Grille
|--------------------------------------------------------------------------*/
Route::get('grille', function(){
	return View::make('tresorerie/layout');
});

Route::get('grille/emissions', function(){
	return View::make('tresorerie/layout');
});

Route::get('grille/grille', function(){
	return View::make('tresorerie/layout');
});





/*
|--------------------------------------------------------------------------
| Section prefix "backend"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'backend', 'before' => 'auth'), function() 
{
	Route::get('/', function(){
		return Redirect::to('backend/menus');
	});

	Route::resource('menus', 'MenuController');

	/*----------------------  Utilisateurs  ----------------------------------*/
	Route::resource('user', 'UtilisateurController');
	
});  // Fin de groupe prefix backend


require_once("/frontend/tresorerie/routes.php");



