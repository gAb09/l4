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

		// $compte = Compte::find(1);
		// $compte = new Compte;
			// echo $compte->numero.'<br />';
					// $compte->makeRoot();
					// $compte->save();

// $test = Compte::create(array('description_lmh' => 999999));
// $test2 = Compte::create(array('numero' => 888888));
// 		$test2->makeChildOf($test);


		$roots = Compte::roots()
		->get();

		$root = Compte::find(862);
		$compte = Compte::find(858);
// dd($root);
// dd($compte);
// 		// dd(Compte::whereBetween('id', array('2', '10'))->get());

		// $compte->makeChildOf($root);
			// $compte->save();

		$comptes = Compte::orderBy('numero', 'asc')->get();

		/* Attribution du nom des classes selon les valeurs de certains attributs */
		$comptes->map(function($compte){
			$compte->classe_actif = ($compte->actif)? 'actif' : '';
			$compte->classe_pco = ($compte->pco)? 'pco' : '';
		});


		return View::Make('compta.comptes.index')->with('comptes', $comptes)->with('roots', $roots);
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

		/* Fournir une modification des règles au validateur */
		$rules = array('numero' => 'unique:comptes,id,'.$id.'|required|not_in:6 chiffres max',);

		$validate = $this->validateur->validate(Input::all(), $rules);

		if($validate === true) 
		{
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
