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
		$validate = $this->validateur->validate(Input::all());


		if($validate !== true) {
			
// dd($validate);
			return Redirect::to('login')
			->withErrors($validate)
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

				return Redirect::intended('/');

			} else {
				// dd('identification pas OK !!!'); // CTRL

				return Redirect::to('login')
				->withErrors('Désolé l’identification a échoué. veuillez réessayer')
				->withInput(Input::all());
			}
		}
	}
}