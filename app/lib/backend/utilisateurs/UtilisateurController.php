<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationUtilisateur;

class UtilisateurController extends \BaseController {


	protected $validateur;


	public function __construct(ValidationUtilisateur $validateur)
	{
		$this->validateur = $validateur;
	}



	public function identification() {

		$validation = $this->validateur->validate(Input::all(), $modes);


		if($validation !== true) {
			
// dd($validation);
			return Redirect::to('login')
			->withErrors($validation)
			->withInput(Input::all())
			;

		} else {

			$utilisateur_checked = Utilisateur::where('login', Input::get('login'))->first();
			// var_dump($utilisateur_checked); // CTRL
			// echo $utilisateur_checked->password; // CTRL
			// echo Hash::make('tempo'); // CTRL
			// echo Input::get('password'); // CTRL

			if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password')))) {
				// dd('identification ok !!!');

				return Redirect::to('/');

			} else {
				// dd('identification pas OK !!!'); // CTRL

				return Redirect::to('login')->withErrors('Désolé l’identification a échoué. Veullire réessayer');
			}
		}
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

		return View::make('admin/utilisateurs/create')
		;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// return 'Enregistrement new utilisateur'; // CTRL 
// dd(Input::all());

		$validate = $this->validateur->validate(Input::all());
// dd($validate);

		if($validate === true) {
			
// dd('OK');


			$utilisateur = Utilisateur::create(array(
				'login' => Input::get('login'),
				'password' => Hash::Make(Input::get('mdp')),
				'mail' => Input::get('mail')
				));


			Session::flash('success', 'l’utilisateur "'.Input::get('login').'" a bien été créé');              
			return Redirect::back();

		} else {

// dd('pas OK');
			return Redirect::back()
			->withErrors($validate)
			->withInput(Input::all())
			;
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


	public function updatemdp($id) {
		// return 'enregistrement des modifications du MOT DE pASSE de l’utilisateur n°' . $id;

		$utilisateur = Utilisateur::find($id);
		$utilisateur->password = Hash::Make(Input::get('new_mdp'));
		$utilisateur->save();
		return Redirect::back();
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