<?php

Route::get('compta/tost', function()
{
	return View::make('tost');
});

Route::get('changedate', function()
	{
	return View::make('ChangeFormatDate');
	});



/*
|--------------------------------------------------------------------------
| Route racine
|--------------------------------------------------------------------------*/
Route::get('/', function()
{
	return Redirect::route('home');
});


/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------*/
Route::get('login', function()
{
	// return 'login';
	return View::make('identification/form')->withTitre_page('ttst');
});

Route::post('identification', 'UtilisateurController@identification');


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

	Route::get('tost', 'TostController@tost');

	/*----------------------  Recettes dépenses  -----------------------------*/
	Route::get('recdep/{id?}', 'RecDepController@index');


// /*----------------------  Pointage  ----------------------------------*/
	Route::post('pointage/{id?}-{statut_id}', 'PointageController@pointage');
	Route::get('pointage/{id?}', array('as' => 'home', 'uses' => 'PointageController@index'));


	/*----------------------  Prévisionnel  ----------------------------------*/
	Route::get('previsionnel', function(){
		return View::make('compta/previsionnel');
	});

	/*----------------------  Écritures  ----------------------------------*/
	Route::put('ecritures/{id}/ok', array('as' => 'confirmupdate', 'uses' => 'EcritureController@update'));
	Route::get('ecritures/{banque}', array('as' => '', 'uses' => 'EcritureController@index'));
	Route::resource('ecritures', 'EcritureController');

	/*----------------------  Types  ----------------------------------*/
	Route::resource('types', 'TypeController');

	/*----------------------  Comptes  ----------------------------------*/
	Route::resource('comptes', 'CompteController');
	
	/*----------------------  Banques  ----------------------------------*/
	Route::resource('banques', 'BanqueController', 
		array('names' => array('index' => 'banques.test')));
	
	/*----------------------  Notes  ----------------------------------*/
	Route::resource('notes', 'NoteController');
	
});  // Fin de groupe prefix “compta”