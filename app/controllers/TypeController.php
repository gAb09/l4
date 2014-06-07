<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationType;

class TypeController extends BaseController {

	protected $validateur;


	public function __construct(ValidationType $validateur)
	{
		$this->validateur = $validateur;
	}



	public function index()
	{
		$types = Type::all();
		$tost = 'tost';
		return View::Make('compta.types.index')->with('types', $types);
	}



	public function create()
	{
		$type = new Type;
		$type->fillFormForCreate();

		return View::Make('compta.types.create')->with('type', $type);
	}



	public function store()
	{
		// dd(Input::all()); // CTRL
		Type::create(Input::except('_token'));

		Session::flash('success', 'Le type "'.Input::get('nom').'" a bien été créé');
		return Redirect::action('TypeController@index');
	}



	public function edit($id)
	{
		$type = Type::findOrFail($id);

		return View::Make('compta/types/edit')->with('type', $type);
	}

	public function update($id)
	{
		// return dd(Input::all());

		$item = Type::findOrFail($id);

		$item->nom = Input::get('nom');
		$item->description = Input::get('description');
		$item->req_banque2 = (Input::get('req_banque2')) ? 1 : 0;
		$item->req_justif = (Input::get('req_justif')) ? 1 : 0;
		$item->sep_justif = Input::get('sep_justif');

		$item->save();

		Session::flash('success', 'Le type "'.Input::get('nom').'" a bien été modifié');
		return Redirect::action('TypeController@index');
	}

	public function destroy($id)
	{
		$item = Type::findOrFail($id);
		$item->delete();

		Session::flash('success', "Le type “$item->nom'” a bien été supprimé");
		return Redirect::action('TypeController@index');
	}

}
