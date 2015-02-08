<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ImportController extends BaseController {

	private static $i = 0;


	public static function importe()
	{
		$imports = Import::all();
			// dd($imports->toArray());

		$imports->each(function($objet) use ($imports)
		{

			$import = $objet['attributes'];
			// var_dump($import);

			$ecriture = new Ecriture;

			$dateOK = self::transDate($import)['date'];
				// var_dump($dateOK);

			$ecriture->date_emission = $dateOK;
			$ecriture->date_valeur = $dateOK;
			$ecriture->type_id = self::transType($import)['type'];
			$ecriture->libelle = self::transLibelle($import)['libelle'];
			$ecriture->libelle_detail = self::transLibelle($import)['detail'];
			$ecriture->signe_id = self::transSigne($import)['signe'];
			$ecriture->montant = NombresFr::sauv(self::transSigne($import)['montant']);
			$ecriture->banque_id = 1;
			$ecriture->compte_id = 5;
			$ecriture->is_double = null;

			self::$i++;

			// var_dump(self::$i);
			// var_dump($ecriture['attributes']);

			$ecriture->save();

		});

		dd(self::$i);
		// return var_dump($imports);
	}

	public static function transDate($import)
	{
		if(is_null($import['date']))
		{
			$import['date'] = '2015-12-31';
			return $import;
		}

		$parts = explode('/', $import['date']);
		$import['date'] = implode('-', [$parts[2], $parts[1], $parts[0]]).' 00:00:00';
		// var_dump($import['date']);

		return $import;
	}


	public static function transType($import)
	{
		if(is_null($import['type']))
		{
			$import['type'] = 10;
			return $import;
		}

		/* Si le contenu est numérique c'est qu'il s'agissait d'un chèque */
		if(is_numeric($import['type']))
		{
			$import['justificatif'] = $import['type'];
			$import['type'] = 2;
			return $import;
		}

		switch ($import['type']) {
			case 'Prélèvement':
			$import['type'] = 1;
			break;
			
			case 'Chèque':
			$import['type'] = 2;
			break;
			
			case 'Virement':
			$import['type'] = 3;
			break;
			
			case 'CB achat':
			$import['type'] = 4;
			break;

			case 'Remise chq':
			$import['type'] = 5;
			break;

			case 'CB achat internet':
			$import['type'] = 7;
			break;

			case 'TIP':
			$import['type'] = 8;
			break;
			
			case 'Report':
			$import['type'] = 9;
			break;
			
			case 'Indéfini':
			$import['type'] = 10;
			break;
			
			case 'Mouvement espèces':
			$import['type'] = 11;
			break;
			
			case 'Espèces retrait':
			$import['type'] = 12;
			break;
			
			case 'Espèces dépôt':
			$import['type'] = 13;
			break;
			
			default:
			$import['type'] = 10;
			break;
		}
		return $import;

	}

	public static function transLibelle($import)
	{
		if(is_null($import['libelle']))
		{
			$import['libelle'] = '?????';
			$import['detail'] = '';
			return $import;
		}

		if(strpbrk($import['libelle'], ' ') == true)
		{
			$import['detail'] = ltrim(strpbrk($import['libelle'], ' '));
		}else{
			$import['detail'] = '';
		}
		$import['libelle'] = explode(' ', $import['libelle'])[0];
		return $import;
	}

	public static function transSigne($import)
	{
		if(is_null($import['depense']))
		{
			$import['montant'] =$import['recette'];
			$import['signe'] = 2;
		}else{
			$import['montant'] = $import['depense'];
			$import['signe'] = 1;
		}

		return $import;
	}

}
