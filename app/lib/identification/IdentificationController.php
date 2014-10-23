<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lib\Validations\ValidationIdentification;

class IdentificationController extends \BaseController {


	protected $validateur;


	public function __construct(ValidationIdentification $validateur)
	{
		$this->validateur = $validateur;
	}



	public function identification() {
		$validation = $this->validateur->valider(Input::all());

		if($validation !== true) {

			return Redirect::to('login')
			->withErrors($validation)
			->withInput(Input::all())
			;

		} else {

			$utilisateur_checked = Utilisateur::where('login', Input::get('login'))->first();
			// var_dump($utilisateur_checked); // CTRL
			// echo $utilisateur_checked->password; // CTRL
			// dd(Hash::make('tempo')); // CTRL
			// echo Input::get('password'); // CTRL

			if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password')))) {
				// dd('identification ok !!!');
				return Redirect::intended('/')
				;

			} else {
				// dd('identification pas OK !!!'); // CTRL

				return Redirect::to('login')
				->with('erreur', 'Désolés, votre identification a échouée…')
				->withInput(Input::all());
			}
		}
	}
}
