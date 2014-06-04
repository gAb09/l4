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
		
		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()) {
			// return 'failed';  // CTRL
			return Redirect::to('identification')->withErrors($validator);

		} else {  //validation OK
			// return 'vlaidation ok';

			$utilisateurs = Utilisateur::where('pseudo', Input::get('pseudo'))->get();
			$utilisateur_checked = $utilisateurs[0];
			// return var_dump($utilisateurs);
			// return var_dump($utilisateur_checked);
			// echo $utilisateur_checked->password;
			echo 'strlen : ' . strlen($utilisateur_checked->password);

			if (strlen($utilisateur_checked->password) == 40) { // Si ancien codage
				// return 'ancien codage'; //CTRL
				if (Helpers::AncienCodage(Input::get('password')) != $utilisateur_checked->password) { // On utilise l'ancienne méthode

					//	Si Identification ancienne PAS ok
				return "ancienne Identification failed. Faire lien vers password reminder";

				} else { // Identification ancienne OK
					// return 'Ok via ancienne méthode'; // CTRL

					// transfert ancien hasch dans paswd_old
					$utilisateur_checked->pswd_old = $utilisateur_checked->password;

					// Nouveau hachage => password
					$utilisateur_checked->password = Hash::Make(Input::get('password'));
					$utilisateur_checked->save();

					Auth::loginUsingId($utilisateur_checked->id);
					Session::put('methode', 'ancienne');

					return Redirect::to('utilisateurs/espace_utilisateur');
				}
			}
// return 'nouveau codage';
			// return Input::get('password');
			//	Identification nouvelle méthode
			if (Auth::attempt(array('pseudo' => Input::get('pseudo'), 'password' => Input::get('password')))) {
				// return 'OK !!!';
				Session::put('methode', 'nouvelle');

				return Redirect::to('utilisateurs/espace_utilisateur');

			} else {
				// return 'Pas Ok…';
				return Redirect::to('guest/identification');
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
		Utilisateur::unguard();
		$utilisateur = Utilisateur::create(array(
			'pseudo' => Input::get('pseudo'),
			'password' => Hash::Make(Input::get('password')),
			'prenom' => Input::get('prenom'),
			'nom' => Input::get('nom'),
			// 'numero_client' => ???,
			'ad1' => Input::get('ad1'),
			'ad2' => Input::get('ad2'),
			'cp' => Input::get('cp'),
			'ville' => Input::get('ville'),
			'telephone' => Input::get('telephone'),
			'mobile' => Input::get('mobile'),
			'mail' => Input::get('mail')
			));

		$utilisateurs = Utilisateur::where('pseudo', Input::get('pseudo'))->get();
		// return var_dump($utilisateurs); // CTRL
		$utilisateur_checked = $utilisateurs[0];
		Auth::loginUsingId($utilisateur_checked->id);
		// return var_dump($utilisateur_checked->pseudo); // CTRL

		return Redirect::to('utilisateurs/espace_utilisateur');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// return 'show utilisateur n°' . $id; // CTRL
		return View::make('utilisateurs/layout')
		->nest('contenu', 'utilisateurs/espace_utilisateur')
		;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		return 'formulaire de modification du utilisateur n°' . $id;
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