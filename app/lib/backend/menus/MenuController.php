<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationMenu;

class MenuController extends \BaseController {

	protected $validateur;

	public function __construct(ValidationMenu $validateur)
	{
		$this->validateur = $validateur;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$menus = Menu::orderBy('parent_id')->orderBy('rang')->get();

		return View::make('backend.menus.index')->with(compact('menus'));
	}



	public function create() {
		// return 'create menu';
		$menu = Menu::fillFormForCreate();

		return View::make('backend.menus.create')->with(compact('menu'));
	}



	public function store() {
		// return 'Store un nouveau "Menu"';

// dd(Input::all()); // CTRL
		$publication = (Input::get('publication')) ? 1 : 0;
		$menu = Menu::create(array(
			'etiquette' => Input::get('etiquette'),
			'nom_sys' => Input::get('nom_sys'),
			'publication' => $publication,
			'rang' => Input::get('rang'),
			'route' => Input::get('route'),
			'description' => Input::get('description') ? Input::get('description') : 'Sans description',
			));

		$parent_id = (Input::get('parent_id'));

		if ($parent_id != 0) {
			$menu->makeChildOf(Menu::findOrFail($parent_id));
		}

		return Redirect::to('backend/menus');
	}



	public function edit($id) {
//		return 'Edition du Menu n°'.$id;

		$menu = Menu::findOrFail($id);
		// var_dump($menu); // CTRL

		return View::make('backend/menus/edit')->with(compact('menu'));
	}



	public function update($id) {
		// return "Alors tu l'update ton menu n° $id";

		// dd(Input::all()); //CTRL

		$menu = Menu::find($id);

		$menu->nom_sys = Input::get('nom_sys');
		$menu->etiquette = Input::get('etiquette');
		$menu->publication = Input::get('publication');
		$menu->rang = Input::get('rang');
		$menu->route = Input::get('route');
		$menu->description = Input::get('description');

		$parent_id = (Input::get('parent_id'));

		if ($parent_id != 0) {
			$menu->makeChildOf(Menu::findOrFail($parent_id));
		}else{
			$menu->makeRoot();
		}

		$menu->save();

		// return var_dump($menu); //CTRL
		return Redirect::to('backend/menus');
	}



	public function destroy($id) {
		// return 'Suppression de l’item ou du menu n°'.$id;

		$menu = Menu::FindOrFail($id);

		$desc = $menu->getDescendants();

		if ($desc->count()) {
			return Redirect::to('backend/menus')->withErrors('L’item “'.$menu->etiquette.'” possède des descendants, 
				veuillez d‘abord les déplacer ou les supprimer.');
		} else {
		$menu->delete();
			Session::flash('success', 'L’item "'.$menu->etiquette.'" a bien été supprimé');
			return Redirect::to('backend/menus');
		}

	}

}

