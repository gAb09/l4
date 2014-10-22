<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ImportController extends BaseController {




	public static function importe()
	{
		$imports = Import::all();

		$imports->each(function($objet) use ($imports)
		{

			$import = $objet['attributes'];
			// var_dump($import);

			$ecriture = new Ecriture;

			$ecriture->date_emission = '2014-12-31 00-00-00';
			$ecriture->date_valeur = self::transDate($import)['date'].' 00-00-00';
			$ecriture->type_id = self::transType($import)['type'];
			$ecriture->libelle = self::transLibelle($import)['libelle'];
			$ecriture->libelle_detail = self::transLibelle($import)['libelle_detail'];
			$ecriture->signe_id = self::transSigne($import)['signe'];
			$ecriture->montant = Nbre::sauv(self::transSigne($import)['montant']);
			$ecriture->banque_id = 1;
			$ecriture->compte_id = 5;
			$ecriture->is_double = null;

			$ecriture->save();

			var_dump($ecriture['attributes']);
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
		$import['date'] = implode('-', [$parts[2], $parts[1], $parts[0]]);
		// var_dump($import['date']);

		return $import;
	}


	public static function transType($import)
	{
		if(is_null($import['type']))
		{
			$import['type'] = 99;
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
			
			case 'Virement':
			$import['type'] = 3;
			break;
			
			case 'Remise chq':
			$import['type'] = 5;
			break;

			case 'Dépôt espèces':
			$import['type'] = 12;
			break;
			
			case 'Paiement CB':
			$import['type'] = 7;
			break;
			
			case 'Virement interne':
			$import['type'] = 13;
			break;
			
			default:
			$import['type'] = 99;
			break;
		}
		return $import;

	}

	public static function transLibelle($import)
	{
		if(is_null($import['libelle']))
		{
			$import['libelle'] = '?????';
			$import['libelle_detail'] = '';
			return $import;
		}

		if(strpbrk($import['libelle'], ' ') == true)
		{
			$import['libelle_detail'] = ltrim(strpbrk($import['libelle'], ' '));
		}else{
			$import['libelle_detail'] = '';
		}
		$import['libelle'] = explode(' ', $import['libelle'])[0];
		return $import;
	}

	public static function transSigne($import)
	{
		if(is_null($import['debit']))
		{
			$import['montant'] =$import['credit'];
			$import['signe'] = 2;
		}else{
			$import['montant'] = $import['debit'];
			$import['signe'] = 1;
		}

		return $import;
	}

}
