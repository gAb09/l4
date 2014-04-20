<?php

class NoteController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function store()
	{
		// return 'Enregistrement d’une nouvelle note';  // CTRL
		Note::create(array(
			'path' => Notes::cleanPathNotes(Input::get('path')),
			'aide' => Input::get('aide'),
			'dev' => Input::get('dev'),
			));
		return Redirect::Back();
	}

	public function update($id)
	{
		// return 'update de la note n° '.$id;  // CTRL

		$note = Note::find($id);

		$note->aide = Input::get('aide');
		$note->dev = Input::get('dev');

		$note->save();

		return Redirect::Back();
	}

	public function destroy($id)
	{
		return 'effacement de la note n° '.$id;  // CTRL

		$note = Note::find($id);
		$note->delete();

		return Redirect::to('compta/notes');
	}

}
