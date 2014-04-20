<?php

class BanqueController extends BaseController {

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
		$banques = Banque::where('id', '>', 0)->get();

		return View::Make('compta/banques/index')->with(compact('banques'));
	}

	public function create()
	{
		// return 'Formulaire pour la création d\'une banque';  // CTRL

		$banque = Banque::fillFormForCreate(); // aPo : Conserver ?

		return View::Make('compta/banques/create')->with(compact('banque'));
	}

	public function store()
	{
		// return 'Enregistrement d\'une nouvelle banque';  // CTRL

		$validator = Validator::make(Input::all(), Banque::StoreRules(), Banque::Messages());

		if ($validator->fails()) {
			// return 'fails'; // CTRL
			return Redirect::back()->withErrors($validator);

		} else {
			// return 'OK'; // CTRL
			if(Banque::create(array(
				'nom' => Input::get('nom'),
				'description' => Input::get('description'),
				)))
			{
				Session::flash('success', 'La banque "'.Input::get('nom').'" a bien été crée');
			}

			return Redirect::route('compta.banques.index');
		}
	}

	public function edit($id)
	{
		// return 'edition de la banque n° '.$id;  // CTRL

		$banque = Banque::FindOrFail($id);

		return View::Make('compta/banques/edit')->with(compact('banque'));
	}

	public function update($id)
	{
		// return 'update de la banque n° '.$id;  // CTRL

		$validator = Validator::make(Input::all(), Banque::UpdateRules(), Banque::Messages());

		if ($validator->fails()) {
			// return 'failed';  // CTRL

			return Redirect::back()->withErrors($validator);

		} else {  //
		// return 'validation OK';  // CTRL

			$item = Banque::find($id);

			$item->nom = Input::get('nom');
			$item->description = Input::get('description');

			$item->save();

			return Redirect::route('compta.banques.index');
		}
	}

	public function destroy($id)
	{
		// return 'effacement de la banque n° '.$id;  // CTRL

		$item = Banque::find($id);
		if ($item->delete()) {
			Session::flash('success', 'La banque "'.$item->nom.'" a bien été supprimée');
		};

		return Redirect::to('compta/banques');
	}

}
