<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ImportController extends BaseController {




	public static function importe()
	{
		$imports = Import::all();

		$imports->each(function($objet) use ($imports)
		{
			$import = $objet['attributes'];
			var_dump($import);

			$import = self::transDate($import);
			$import = self::transType($import);

			var_dump($import);
		});

		// return var_dump($imports);
	}

	public static function transDate($import)
	{
		if(is_null($import['date']))
		{
			$import['date'] = '2014/12/31';
			return $import;
		}
		$parts = explode('/', $import['date']);
		$import['date'] = implode('/', [$parts[2], $parts[1], $parts[0]]);

		return $import;
	}


	public static function transType($import)
	{
		if(is_null($import['type']))
		{
			$import['type'] = 11;
			return $import;
		}
		if(is_numeric($import['type']))
		{
			$import['justificatif'] = $import['type'];
			$import['type'] = 2;
			return $import;
		}
		return $import;

	}















	public function store($import)
	{
		$import = new Ecriture;
		$banque->create(Input::except('_token'));
		Session::flash('success', 'La banque "'.Input::get('nom').'" a bien été crée');              
		return Redirect::action('BanqueController@index');
	}

}
