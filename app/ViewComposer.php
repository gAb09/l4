<?php

/* appel des notes (Aide et Développement) en fonction de la page demandée */
View::composer('compta/fenetre_note', function($view) {
	if ($note = DB::table('notes')->where('path', '=', Notes::cleanPathNotes(Request::path()))->first())
	{
		$view->with('note', $note);
	}
});


/* Placement conditionnel de l'appel js sur pages ecritures */
View::composer('compta/layout', function($view) {
	if(Request::segment(2) == 'ecritures')
	{
		$body = 'onLoad="initialise();"';
	}else
	{
		$body = '';
	}

	$view->with('body', $body);
});


/* Composition du menu principal */
View::composer('compta/layout', function($view) {
	
	$sections = Menu::roots()->where('publication', '=', 1)->get();

	$sections = $sections->sortBy(function($sections)
	{
		return $sections->rang;
	});

	$view->with(compact('sections'));
});


/* Composition du sous-menu */
View::composer('compta/layout', function($view) {
	
	$section = Menu::where('nom_sys', '=', Request::segment(1))->get();
	$menus = Menu::where('parent_id', '=', $section[0]->id)->get();

	$view->with(compact('menus'));
});

?>