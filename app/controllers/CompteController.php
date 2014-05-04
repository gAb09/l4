<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationCompte;

class CompteController extends BaseController {

	protected $validateur;


	public function __construct(ValidationCompte $validateur)
	{
		$this->validateur = $validateur;
	}



	public function index()
	{
		$comptes = Compte::orderBy('updated_at', 'desc')->get();

		return View::Make('compta.comptes.index')->with('comptes', $comptes);
	}



	public function create()
	{
		$compte = Compte::fillFormForCreate();

		return View::Make('compta.comptes.create')->with('compte', $compte);
	}



	public function store()
	{
		return dd(Input::except('_token')); // CTRL

		$validate = $this->validateur->validate(Input::all());

		if($validate === true) 
		{
			// return 'OK'; // CTRL
			$compte = new Compte;
			$compte->create(Input::except('_token'));
			Session::flash('success', 'Le compte "'.Input::get('nom').'" a bien été créé');              
			return Redirect::action('CompteController@index');
		} else {
			// return 'fails'; // CTRL
			return Redirect::back()->withInput(Input::all())->withErrors($validate);
		}
	}




	public function edit($id)
	{
		$compte = Compte::FindOrFail($id);

		return View::Make('compta/comptes/edit')->with('compte', $compte);
	}



	public function update($id)
	{
		// return dd(Input::all());  // CTRL

		$item = Compte::FindOrFail($id);

		$lmh = (Input::has('lmh')) ? 1 : 0 ; // aFa revoir conception entitè
		$actif = (Input::has('actif')) ? 1 : 0 ;

		/* Fournir une modification des règles au validateur */
		$rules = array('numero' => 'unique:comptes,id,'.$id.'|required|not_in:6 chiffres max',);

		$validate = $this->validateur->validate(Input::all(), $rules);

		if($validate === true) 
		{
			$item->fill(array('lmh' => $lmh, 'actif' => $actif), Input::except('_method', '_token'));

			$item->save();

			Session::flash('success', 'Le compte "'.Input::get('nom').'" a bien été modifié');              
			return Redirect::action('CompteController@index');
		} else {
			// return 'fails'; // CTRL
			return Redirect::back()->withInput(Input::all())->withErrors($validate);
		}
	}



	public function destroy($id)
	{
		$item = Compte::FindOrFail($id);
		$item->delete();

		Session::flash('success', 'Le compte "'.Input::get('nom').'" a bien été supprimé');              

		return Redirect::action('CompteController@index');
	}

}
