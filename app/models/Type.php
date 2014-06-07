<?php

class Type extends Eloquent {
	use ModelTrait;

	protected $guarded = array('id'); // AFA
	protected $softDelete = true; // AFA

	protected static $unguarded = true; // AFA

	protected $default_values_for_create = array(
		'nom' => 'Nom du type d’écriture',
		'description' => 'Saisir ici la description éventuelle. En dessous, préciser si ce type d’écriture requiert un justificatif et le cas échéant, le séparateur.',
		'req_justif' => 0,
		'sep_justif' => 'Ici, texte de séparation',
	);

	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}


	/* —————————  ACCESSORS  —————————————————*/


	/* —————————  MUTATORS  —————————————————*/




	/* —————————  Helpers  —————————————————*/ // aFa passer en requete ajax traitée par controleur ??
	/* Obtenir (au format json) la liste des "id" des types d'écriture requérant une banque liée */
	public static function type_dble_ecriture()
	{
		$req_banque2 = Type::where('req_banque2', 1)->get(array('id'))->toArray();

		foreach ($req_banque2 as $key => $value) {
			$array[] = ''.$value['id'].'';
		}

		return $array;
		// dd($array); // CTRL
	}

}