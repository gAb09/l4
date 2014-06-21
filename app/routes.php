<?php


Route::get('compte/{id}', function($id)
{
	return var_dump(Compte::where('id', $id)->first()->lft);
});

// Route::get('compta/trans', function()
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
	return View::make('identification/form')
	->with('titre_page', 'Identification')
	;
}));

Route::post('identification', 'IdentificationController@identification');

/*
|--------------------------------------------------------------------------
| Dashboard / Prefix "dash"
|--------------------------------------------------------------------------*/

Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function() 
{
	Route::get('/', function(){
		return Redirect::to('dashboard/show');
	});

	Route::get('deconnexion', array('as' => 'deconnexion', 'uses' => 'DashboardController@deconnexion'));

	Route::get('show', function()
	{
		return View::make('dashboard.show')
		->with('titre_page', 'Mon compte')
		;
	});

	Route::get('update', function()
	{
		return View::make('dashboard.update')
		->with('titre_page', 'Mon compte')
		;
	});

	Route::get('updatemdp', function()
	{
		return View::make('dashboard.updatemdp')
		->with('titre_page', 'Mon compte')
		;
	});

	Route::resource('user', 'UtilisateurController');
	Route::put('user/mdp/{id?}', 'UtilisateurController@updatemdp');
});  // Fin de groupe prefix admin

/*
|--------------------------------------------------------------------------
| Section Grille
|--------------------------------------------------------------------------*/
Route::get('grille', function(){
	return View::make('compta/layout');
});

Route::get('grille/emissions', function(){
	return View::make('compta/layout');
});

Route::get('grille/grille', function(){
	return View::make('compta/layout');
});





/*
|--------------------------------------------------------------------------
| Section prefix "admin"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() 
{
	Route::get('/', function(){
		return Redirect::to('admin/menus');
	});

	Route::resource('menus', 'MenuController');

	/*----------------------  Statuts  ----------------------------------*/
	Route::resource('statuts', 'StatutController');
	
});  // Fin de groupe prefix admin






/*
|--------------------------------------------------------------------------
| Section prefix "compta"
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'compta', 'before' => 'auth'), function() 
{


	Route::get('/', function(){
		return Redirect::to('compta/ecritures');
	});

	Route::get('statuts', function(){
		return View::make('compta/statuts_visu');
	});

	Route::get('tost', 'TostController@tost');

	/*----------------------  Recettes dépenses  -----------------------------*/
	Route::get('recdep/{id?}', 'RecDepController@index');


// /*----------------------  Pointage  ----------------------------------*/
	Route::post('pointage/{id?}-{statut_id}', 'PointageController@pointage');
	Route::get('pointage/{id?}', array('as' => 'pointage', 'uses' => 'PointageController@index'));


	/*----------------------  Prévisionnel  ----------------------------------*/
	Route::get('previsionnel', function(){
		return View::make('compta/previsionnel');
	});

	/*----------------------  Écritures  ----------------------------------*/
	// Route::put('ecritures/{id}/ok', array('as' => 'confirmupdate', 'uses' => 'EcritureController@update'));
	Route::get('banque/{banque}', array('as' => 'bank', 'uses' => 'EcritureController@index'));
	Route::resource('ecritures', 'EcritureController');

	/*----------------------  Types  ----------------------------------*/
	Route::resource('types', 'TypeController');

	/*----------------------  Comptes  ----------------------------------*/
	Route::get('comptes/freres', 'CompteController@freres');
	Route::get('comptes/{id?}/freres', 'CompteController@freres');
	Route::get('comptes/classe/{root?}', 'CompteController@index');
	Route::resource('comptes', 'CompteController');

	/*----------------------  Banques  ----------------------------------*/
	Route::resource('banques', 'BanqueController');

	/*----------------------  Notes  ----------------------------------*/
	Route::resource('notes', 'NoteController');

});  // Fin de groupe prefix “compta”


