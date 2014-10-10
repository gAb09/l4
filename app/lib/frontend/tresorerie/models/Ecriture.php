<?php
use lib\shared\Traits\ModelTrait;

class Ecriture extends Eloquent {
	use ModelTrait;

	protected $guarded = array('id');
	protected $softDelete = true; // AFA


	public static function mutator() // aFa remove ?
	
	{
		return static::$mutatorCache;
	}

	protected static $default_values_for_create = array(
		'banque_id' => 0,
		'date_valeur' => CREATE_FORM_DEFAUT_TXT_DATE,
		'date_emission' => CREATE_FORM_DEFAUT_TXT_DATE,
		'montant' => 0,
		'type_id' => 0,
		'libelle' => CREATE_FORM_DEFAUT_TXT_LIBELLE,
		'libelle_detail' => CREATE_FORM_DEFAUT_TXT_LIBELLE_COMPL,
		'justificatif' => CREATE_FORM_DEFAUT_TXT_JUSTIF,
		'compte_id' => 0,
		'double_flag' => false,
		);


	/* —————————  RELATIONS  —————————————————*/

	public function type()
	{
		return $this->belongsTo('Type');
	}

	public function compte()
	{
		return $this->belongsTo('Compte');
	}

	public function banque()
	{
		return $this->belongsTo('Banque');
	}

	public function ecriture2()
	{
		return $this->belongsTo('Ecriture', 'double_id');
	}

	public function signe()
	{
		return $this->belongsTo('Signe');
	}

	public function statut()
	{
		return $this->belongsTo('Statut');
	}


	/* —————————  DATES  —————————————————*/
	public function getDates()
	{
		return array('created_at', 'updated_at', 'deleted_at', 'date_valeur', 'date_emission');
	}


	/* —————————  ACCESSORS  —————————————————*/
	// public function getMontantAttribute($value)
	// {
	// 	$value = Nbre::francais($value);
	// 	return $value;
	// }



	/* —————————  MUTATORS  —————————————————*/

	public function setMontantAttribute($value)
	{

		$value = Nbre::sauv($value);
		$this->attributes['montant'] = $value;
	}

}
