<?php

class Type extends Eloquent {

	protected static $unguarded = true; // AFA

	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}


	/* —————————  ACCESSORS  —————————————————*/


	/* —————————  MUTATORS  —————————————————*/


	/* —————————  Liste de sélection  —————————————————*/

	public static function listForInputSelect()
	{
		$list[0] = 'Faire une sélection';
		foreach(static::all() as $type)
		{
			$list[$type->id] = $type->nom;
		}
		return $list;

	}

	public static function fillFormForCreate()
	{
		$type = new Type();
		$type->nom = 'Nom du type d’écriture';
		$type->description = 'Ici la description éventuelle. En dessous, préciser si ce type d’écriture requiert une banque de destination, un justificatif et dans ce dernier cas les caractères de séparation pour les cas où le nom du type et le justificatif sont écrit à la suite l’un de l’autre.';
		$type->req_banque2 = 0;
		$type->req_justif = 0;
		$type->sep_justif = 'Saisir le texte de liaison entre le type et le justificatif lorsqu’ils se trouveront réunis dans le même champ';
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