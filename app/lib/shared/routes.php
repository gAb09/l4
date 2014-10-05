<?php

Route::get('tost', function()
{
	// return 'login';
	return View::make('shared/views/test')
	;
});

Route::get('badges', function()
{
	// return 'login';
	return View::make('shared/views/badges_buttons')
	;
});


Route::get('compte/{id}', function($id)
{
	return var_dump(Compte::where('id', $id)->first()->lft);
});

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
	return Redirect::route('pointage');
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






/*
|--------------------------------------------------------------------------
| Section prefix "tresorerie"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'tresorerie', 'before' => 'auth'), function() 
{


	Route::get('/', function(){
		return Redirect::to('tresorerie/ecritures');
	});

	Route::get('statuts', function(){
		return View::make('frontend/tresorerie/views/statuts/visu');
	});

	Route::get('tost', 'TostController@tost');

	/*----------------------  Recettes dépenses  -----------------------------*/
	Route::get('recdep/{id?}', 'RecDepController@index');


// /*----------------------  Pointage  ----------------------------------*/
	Route::post('pointage/{id?}-{statuts?}', 'PointageController@pointage');
	Route::get('pointage/{banque_id?}', array('as' => 'pointage', 'uses' => 'PointageController@index'));


	/*----------------------  Prévisionnel  ----------------------------------*/
	Route::get('previsionnel', 'PrevController@index');

	/*----------------------  Écritures  ----------------------------------*/
	// Route::put('ecritures/{id}/ok', array('as' => 'confirmupdate', 'uses' => 'EcritureController@update'));
	Route::get('banque/{banque}', array('as' => 'bank', 'uses' => 'EcritureController@indexBanque'));
	Route::get('banque/dupli/{banque}', array('as' => 'dupli', 'uses' => 'EcritureController@duplicate'));
	Route::resource('ecritures', 'EcritureController');

	/*----------------------  Types  ----------------------------------*/
	Route::resource('types', 'TypeController');

	/*----------------------  Comptes  ----------------------------------*/
	Route::get('comptes/freres', 'CompteController@freres');
	Route::get('comptes/{id?}/freres', 'CompteController@freres');
	Route::get('comptes/classe/{root?}', 'CompteController@index');
	Route::any('comptes/updateactif', array('as' => 'tresorerie.comptes.updateActif', 'uses' => 'CompteController@updateActif'));
	Route::resource('comptes', 'CompteController');

	/*----------------------  Banques  ----------------------------------*/
	Route::resource('banques', 'BanqueController');

	/*----------------------  Notes  ----------------------------------*/
	Route::resource('notes', 'NoteController');

	/*----------------------  Statuts  ----------------------------------*/
	Route::get('statutsvisu', 'StatutController@visu');
	Route::get('statuts', 'StatutController@index'); // aFa Résoudre le bug qui 
	Route::resource('statuts', 'StatutController');
	
});  // Fin de groupe prefix “tresorerie”


