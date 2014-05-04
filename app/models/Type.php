<?php

class Type extends Eloquent {
	use ModelTrait;

	protected static $unguarded = true; // AFA

	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}


	/* —————————  ACCESSORS  —————————————————*/


	/* —————————  MUTATORS  —————————————————*/



	public static function fillFormForCreate()
	{
		$type = new Type();
		$type->nom = 'Nom du type d’écriture';
		$type->description = 'Saisir ici la description éventuelle.
En dessous, préciser si ce type d’écriture requiert un justificatif et le cas échéant, le séparateur.';
		$type->req_justif = 0;
		$type->sep_justif = 'Ici, texte de séparation';
		return $type;
	}

	/* —————————  Helpers  —————————————————*/
	/* Obtenir (au format json) la liste des "id" des types d'écriture requérant une banque liée */
	public static function type_dble_ecriture()
	{
		$req_banque2 = Type::where('req_banque2', '=', 1)->get(array('id'))->toArray();

		foreach ($req_banque2 as $key => $value) {
			$array[] = ''.$value['id'].'';
		}

		return $array;
		// dd($array); // CTRL
	}

}