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

Route::get('import', function()
{
	return ImportController::importe();
});


/*
|--------------------------------------------------------------------------
| Route racine
|--------------------------------------------------------------------------*/
Route::get('/', function()
{
	return Redirect::to('tresorerie/journal');
});

Route::get('admin', function()
{
	return Redirect::to('admin/menus');
});









require_once("modules/tresorerie/routes.php");

require_once("lib/dashboard/routes.php");

require_once("lib/grille/routes.php");

require_once("lib/menus/routes.php");

require_once("lib/utilisateurs/routes.php");

require_once("lib/identification/routes.php");

