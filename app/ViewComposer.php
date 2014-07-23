<?php
// aFa  décomposer en plusieurs viewcomposer ?

/* Composition du menu principal */
View::composer('compta/layout', function($view) {
	
	$sections = Menu::roots()->where('publication', 1)->get();

	$sections = $sections->sortBy(function($sections)
	{
		return $sections->lft;
	});

	$view->with(compact('sections'));
});


/* Composition du sous-menu */
View::composer('compta/layout', function($view) {

	$section = Menu::where('nom_sys', Request::segment(1))->get();
	$menus = Menu::where('parent_id', $section[0]->id)->get();

	$view->with(compact('menus'));
});





View::composer('compta/ecritures/form', function($view)
{
	/* Lister les séparateurs pour le javascript */
	$separateurs = Type::lists('sep_justif', 'id');

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

	$view->with(compact('separateurs'))->with(compact('list_radios'));
});



/* appel des notes (Aide et Développement) en fonction de la page demandée */
View::composer('compta/fenetre_note', function($view) {
	if ($note = DB::table('notes')->where('path', Notes::cleanPathNotes(Request::path()))->first())
	{
		$view->with('note', $note);
	}
});

?>