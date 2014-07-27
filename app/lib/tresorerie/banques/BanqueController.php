<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationBanque;

class BanqueController extends BaseController {

	protected $validateur;


	public function __construct(ValidationBanque $validateur)
	{
		$this->validateur = $validateur;
	}



	public function index()
	{
		$banques = Banque::all();

		return View::Make('tresorerie.banques.index')->with(compact('banques'));
	}



	public function create()
	{
		$banque = new Banque;
		$banque->fillFormForCreate();

		return View::Make('tresorerie.banques.create')->with(compact('banque'));
	}



	public function store()
	{
		// dd(Input::except('_token'));

		$validate = $this->validateur->validate(Input::all());

		if($validate === true) 
		{
			// return 'OK'; // CTRL
			$banque = new Banque;
			$banque->create(Input::except('_token'));
			Session::flash('success', 'La banque "'.Input::get('nom').'" a bien été crée');              
			return Redirect::action('BanqueController@index');
		} else {
			return Redirect::back()->withInput(Input::all())->withErrors($validate);
		}
	}



	public function edit($id)
	{
		$banque = Banque::FindOrFail($id);

		return View::Make('tresorerie.banques.edit')->with(compact('banque'));
	}



	public function update($id)
	{
		$item = Banque::FindOrFail($id);

		/* Fournir une modification des règles au validateur */
		$rules = array('nom' => 'unique:banques,nom,'.$id.'|required|not_in:CREATE_FORM_DEFAUT_TXT_NOM');

		$validate = $this->validateur->validate(Input::all(), $rules);

		if($validate === true) 
		{
			// return 'OK'; // CTRL

			$item->fill(Input::except('_token', '_method'));
			$item->save();

			Session::flash('success', 'La banque "'.Input::get('nom').'" a bien été modifiée');

			return Redirect::action('BanqueController@index');
		} else {
			// return 'fails'; // CTRL
			return Redirect::back()->withInput(Input::all())->withErrors($validate);
		}

	}



	public function destroy($id)
	{
		// return 'effacement de la banque n° '.$id;  // CTRL

		$item = Banque::FindOrFail($id);
		if ($item->delete()) {
			Session::flash('success', "La banque $item->nom a bien été supprimée");
		};

		return Redirect::action('BanqueController@index');
	}

}
