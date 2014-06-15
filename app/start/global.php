<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

setlocale(LC_ALL, 'fr_FR');



/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/helpers',

	));

/*
|--------------------------------------------------------------------------
| Désactiver la debugbar
|-------------------------------------------------------------------------- */
\Debugbar::disable();


/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

App::error(function(ModelNotFoundException $e)
{
  	$message = 'Désolé ! Aucun élément ne correspond à votre demande…';

    return View::Make('404')->with('message', $message);
});

App::missing(function($exception)
{
	$message = 'Oups… Désolé, cette page n\'existe pas !';

    return View::Make('404')->with('message', $message);
});


/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/


require app_path().'/filters.php';
require app_path().'/ViewComposer.php'; // aPo  Est-ce bien là la bonne façon d'autoloader le viewcomposer ??
require app_path().'/validations/CustomRules.php'; // aPo  Est-ce bien là la bonne façon d'autoloader le viewcomposer ??

/*
|--------------------------------------------------------------------------
| CONSTANTES
|--------------------------------------------------------------------------
|
*/

define('CREATE_FORM_DEFAUT_LIST', 'Faire une sélection');

define('CREATE_FORM_DEFAUT_TXT_NOM', 'Saisir un nom');
define('CREATE_FORM_DEFAUT_TXT_DESCRIPTION', 'Saisir une description');
define('CREATE_FORM_DEFAUT_TXT_JUSTIF', 'Éventuellement préciser un justificatif');
define('CREATE_FORM_DEFAUT_TXT_SEPARATEUR', 'Saisir un séparateur');
define('CREATE_FORM_DEFAUT_TXT_COMPTE_NUMERO', 'Six chiffres max');
define('CREATE_FORM_DEFAUT_TXT_LIBELLE', 'Saisissez un libellé clair');
define('CREATE_FORM_DEFAUT_TXT_DATE', '2014-01-01');
define('CREATE_FORM_DEFAUT_TXT_LIBELLE_COMPL', 'Compléter éventuellement le libellé');

define('VERROU', 'Changement écriture simple/double');

define('PAR_PAGE', 30);
