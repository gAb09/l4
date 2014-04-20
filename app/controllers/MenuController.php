<?php

class MenuController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		// Récupération des menus
		$menus = Menu::orderBy('parent_id')->orderBy('rang')->get();
		// return var_dump($menus); // CTRL

		return View::make('admin/menus/index')->with(compact('menus'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		// return 'create menu';
		$menu = Menu::fillFormForCreate();

		return View::make('admin/menus/create')->with(compact('menu'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// return 'Store un nouveau "Menu"';
		Menu::unguard();

		$menu = Menu::create(array(
			'nom_sys' => Input::get('nom_sys'),
			'etiquette' => Input::get('etiquette'),
			'publication' => Input::get('publication') ? 1 : 0,
			'rang' => Input::get('rang'),
			'route' => Input::get('route'),
			'description' => Input::get('description') ? Input::get('description') : 'Sans description',
			));

		$parent_id = (Input::get('parent_id'));

		if ($parent_id != 0) {
			$menu->makeChildOf(Menu::findOrFail($parent_id));
		}

		return Redirect::to('admin/menus');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		return "Alors montre le ton menu n° $id";
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
//		return 'Edition du Menu n°'.$id;

		$menu = Menu::findOrFail($id);
		// var_dump($menu); // CTRL

		return View::make('admin/menus/edit')->with(compact('menu'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// return "Alors tu l'update ton menu n° $id";

//		var_dump(Input::get()); //CTRL

		$menu = Menu::find($id);

		$menu->nom_sys = Input::get('nom_sys');
		$menu->etiquette = Input::get('etiquette');
		$menu->publication = (Input::get('publication')) ? 1 : 0;
		$menu->rang = Input::get('rang');
		$menu->route = Input::get('route');
		$menu->description = Input::get('description');

		$parent_id = (Input::get('parent_id'));

		if ($parent_id != 0) {
			$menu->makeChildOf(Menu::findOrFail($parent_id));
		}

		$menu->save();

		// return var_dump($menu); //CTRL
		return Redirect::to('admin/menus');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// return 'Suppression de l’item ou du menu n°'.$id;

		$menu = Menu::FindOrFail($id);

		$desc = $menu->getDescendants();

		if ($desc->count()) {
			return Redirect::to('admin/menus')->withErrors('L’item “'.$menu->etiquette.'” possède des descendants, 
				veuillez d‘abord les déplacer ou les supprimer.');
		} else {
		$menu->delete();
			Session::flash('success', 'L’item "'.$menu->etiquette.'" a bien été supprimé');
			return Redirect::to('admin/menus');
		}

	}

}

