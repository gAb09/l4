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
		$validate = $this->validateur->validate(Input::all());

		if($validate === true) 
		{

			Type::create(Input::except('_token'));

			Session::flash('success', 'Le type "'.Input::get('nom').'" a bien été créé');

			return Redirect::action('TypeController@index');
		}else{
			return Redirect::back()->withInput(Input::all())->withErrors($validate);
		}
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

		$item->fill(Input::except('_token', '_method'));

		$rules = array('nom' => 'unique:types,nom,'.$id.'|required|not_in:CREATE_FORM_DEFAUT_TXT_NOM');

		$validate = $this->validateur->validate(Input::all(), $rules);

		if($validate === true) 
		{

			$item->save();

			Session::flash('success', 'Le type "'.Input::get('nom').'" a bien été modifié');

			return Redirect::action('TypeController@index');

		}else{
			return Redirect::back()->withInput(Input::all())->withErrors($validate);
		}

	}

	public function destroy($id)
	{
		$item = Type::findOrFail($id);

		$item->delete();

		Session::flash('success', "Le type “$item->nom'” a bien été supprimé");

		return Redirect::action('TypeController@index');
	}

}
