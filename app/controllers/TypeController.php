<?php

class TypeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$types = Type::all();
		return View::Make('compta/types/index')->with('types', $types);
	}

	public function create()
	{
		$type = Type::fillFormForCreate();
		// return 'Formulaire pour la création d\'un type d\'écriture';  // CTRL // AFa
		return View::Make('compta/types/create')->with('type', $type);
	}

	public function store()
	{
		// return 'Enregistrement d\'un nouveau “type d\'écriture“';  // CTRL

		Type::create(array(
			'nom' => Input::get('nom'),
			'description' => Input::get('description'),
			'req_banque2' => (Input::get('req_banque2')) ? 1 : 0,
			'req_justif' => (Input::get('req_justif')) ? 1 : 0,
			'sep_justif' => Input::get('sep_justif'),
			));

		return Redirect::to('compta/types');
	}

	public function edit($id)
	{
		// return 'edition du type n° '.$id;  // CTRL

		$type = Type::find($id);

		return View::Make('compta/types/edit')->with('type', $type);
	}

	public function update($id)
	{
		// return 'update du type n° '.$id;  // CTRL
		// return var_dump( Input::all() );

		$item = Type::find($id);

		$item->nom = Input::get('nom');
		$item->description = Input::get('description');
		$item->req_banque2 = (Input::get('req_banque2')) ? 1 : 0;
		$item->req_justif = (Input::get('req_justif')) ? 1 : 0;
		$item->sep_justif = Input::get('sep_justif');
dd($item);
		$item->save();

		return Redirect::to('compta/types');
	}

	public function destroy($id)
	{
		// return 'effacement du type n° '.$id;  // CTRL

		$item = Type::find($id);
		$item->delete();

		return Redirect::to('compta/types');
	}

}
