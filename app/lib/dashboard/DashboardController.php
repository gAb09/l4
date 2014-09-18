<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationDashboard;

class DashboardController extends \BaseController {


	protected $validateur;


	public function __construct(ValidationDashboard $validateur)
	{
		$this->validateur = $validateur;
	}


	/**
	 * Deconnecte l’utilisateur.
	 *
	 * 
	 */
	public function deconnexion() {

		Auth::logout();
		Session::forget(('success'));
		Session::flash('success', 'Vous venez d’être déconnecté');
		return Redirect::route('login');
	}




	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$utilisateurs = Utilisateur::orderBy('id', 'desc')->get();
		// return 'page abonnés index'; // CTRL
		return View::make('gestion/utilisateurs/utilisateurs')->with('utilisateurs', $utilisateurs)
		->nest('aside', 'gestion/vue_aside')
		;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		// return 'formulaire de création d\'un nouvel utilisateur'; // CTRL

		return View::make('guest/inscription_form')
		;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// return 'Enregistrement new utilisateur'; // CTRL 

		$validate = $this->validateur->validate(Input::all());

		if($validate === false) {
			
// dd($validate);
			return Redirect::back()
			->withErrors($validate)
			->withInput(Input::all())
			;

		} else {


			$utilisateur = Utilisateur::create(array(
				'login' => Input::get('login'),
				'password' => Hash::Make(Input::get('password')),
				'mail' => Input::get('mail')
				));


			Session::flash('success', 'l’utilisateur "'.Input::get('login').'" a bien été créé');              
			return Redirect::back();
		}
}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		return 'enregistrement des modifications du utilisateur n°' . $id;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		// return 'delete utilisateur n°' . $id;
		Utilisateur::destroy($id);
		return Redirect::to('gestion/utilisateurs');

	}

}