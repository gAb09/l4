<?php

class CompteController extends BaseController {

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
		$comptes = Compte::all();
		return View::Make('compta/comptes/index')->with('comptes', $comptes);
	}

	public function create()
	{
		// return 'Formulaire pour la création d\'un compte;  // CTRL
		$compte = Compte::fillFormForCreate();

		return View::Make('compta/comptes/create')->with('compte', $compte);
	}

	public function store()
	{
		// return 'Enregistrement d\'un nouveau compte';  // CTRL
		// return var_dump(Input::all()); // CTRL

		$lmh = (Input::get('lmh')) ? 1 : 0 ;
		$actif = (Input::get('actif')) ? 1 : 0 ;

		Compte::create(array(
			'numero' => Input::get('numero'),
			'libelle' => Input::get('libelle'),
			'description_officiel' => Input::get('description_officiel'),
			'description_comp' => Input::get('description_comp'),
			'description_lmh' => Input::get('description_lmh'),
			'lmh' => $lmh,
			'actif' => $actif,
			));

		return Redirect::to('compta/comptes');
	}

	public function edit($id)
	{
		// return 'edition du compte n° '.$id;  // CTRL

		$compte = Compte::find($id);

		return View::Make('compta/comptes/edit')->with('compte', $compte);
	}

	public function update($id)
	{
		// return 'update du compte n° '.$id;  // CTRL
		 return var_dump(Input::all()); // CTRL

		$item = Compte::find($id);

		$item->description_officiel = Input::get('description_officiel');
		$item->description_comp = Input::get('description_comp');
		$item->description_lmh = Input::get('description_lmh');
		$item->lmh = (Input::get('lmh')) ? 1 : 0;
		$item->actif = (Input::get('actif')) ? 1 : 0;

		$item->save();

		return Redirect::to('compta/comptes');
	}

	public function destroy($id)
	{
		// return 'effacement désactvé';  // CTRL
		// return 'effacement du compte n° '.$id;  // CTRL

		$item = Compte::find($id);
		$item->delete();

		return Redirect::to('compta/comptes');
	}

}
