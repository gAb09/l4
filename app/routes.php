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
	return Redirect::to('tresorerie/journal');
});








require_once("lib/frontend/tresorerie/routes.php");

require_once("lib/frontend/dashboard/routes.php");

require_once("lib/frontend/grille/routes.php");

require_once("lib/identification/routes.php");

require_once("lib/backend/menus/routes.php");

require_once("lib/backend/utilisateurs/routes.php");

require_once("lib/identification/routes.php");

