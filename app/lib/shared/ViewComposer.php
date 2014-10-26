<?php
// aFa  décomposer en plusieurs viewcomposer ?

/* Composition du menu principal */
View::composer('frontend/views/layout', function($view) {
	
	$sections = Menu::where('publication', 1)->whereNull('parent_id')->orderBy('rang')->get();

	$view->with(compact('sections'));
});


/* Composition du sous-menu */
View::composer('frontend/views/layout', function($view) {


	$section = Menu::where('nom_sys', Request::segment(1))->get();
	$menus = Menu::where('parent_id', $section[0]->id)->get();

	$view->with(compact('menus'));
});





View::composer('frontend/tresorerie/views/ecritures/form', function($view)
{
	/* Lister les séparateurs pour le javascript */
	$types = Type::all();

	/* Composer les input radios pour le signe */
	foreach(Signe::all() as $item)
	{
		$list_radios[$item->id]['id'] = 'id';
		$list_radios[$item->id]['name'] = 'signe';
		$list_radios[$item->id]['value'] = $item->id;
		$list_radios[$item->id]['etiquette'] = $item->etiquette;
		$list_radios[$item->id]['id_css'] = 'signe_'.$item->id;
		$list_radios[$item->id]['fonction_js'] = $item->etiquette.'();';
	}

	$view->with(compact('types'))->with(compact('list_radios'));
});



/* appel des notes (Aide et Développement) en fonction de la page demandée */
/*View::composer('backend/aide/fenetre_note', function($view) {
	if ($note = DB::table('notes')->where('path', Notes::cleanPathNotes(Request::path()))->first())
	{
		$view->with('note', $note);
	}
});*/

?>