<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationStatut;

class StatutController extends BaseController {

	protected $validateur;


	public function __construct(ValidationStatut $validateur)
	{
		$this->validateur = $validateur;
	}



	public function index()
	{
		$statuts = Statut::all();

		return View::Make('tresorerie.statuts.index')->with(compact('statuts'));
	}

	public function create()
	{
		// return 'Formulaire pour la création d\'un statut';  // CTRL

		$statut = Statut::fillFormForCreate();

		return View::Make('tresorerie.statuts.create')->with(compact('statut'));
	}

	public function store()
	{
		// return 'Enregistrement d\'un nouveau statut';  // CTRL

		// $validator = Validator::make(Input::all(), Statut::StoreRules(), Statut::Messages());

		// if ($validator->fails()) {
		// 	// return 'fails'; // CTRL
		// 	return Redirect::back()->withErrors($validator);

		// } else {
			// return 'OK'; // CTRL
			if(Statut::create(array(Input::except('_token'))))
			{
				Session::flash('success', 'Le statut "'.Input::get('nom').'" a bien été créé');
			}

			return Redirect::route('tresorerie.statuts.index');
		// }
	}

	public function edit($id)
	{
		// return 'edition du statut n° '.$id;  // CTRL

		$statut = Statut::FindOrFail($id);

		return View::Make('admin/statuts/edit')->with(compact('statut'));
	}

	public function update($id)
	{
		// return 'update du statut n° '.$id;  // CTRL

		// $validator = Validator::make(Input::all(), Statut::UpdateRules(), Statut::Messages());

		// if ($validator->fails()) {
		// 	// return 'failed';  // CTRL

		// 	return Redirect::back()->withErrors($validator);

		// } else {  //
		// // return 'validation OK';  // CTRL

			$item = Statut::find($id);

			$item->nom = Input::get('nom');
			$item->classe = Input::get('classe');
			$item->description = Input::get('description');

			$item->save();

			return Redirect::route('tresorerie.statuts.index');
		// }
	}

	public function destroy($id)
	{
		// return 'effacement du statut n° '.$id;  // CTRL

		$item = Statut::find($id);
		if ($item->delete()) {
			Session::flash('success', 'Le statut "'.$item->nom.'" a bien été supprimé');
		};

		return Redirect::to('admin/statuts');
	}

}
