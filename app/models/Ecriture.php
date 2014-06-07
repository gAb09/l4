<?php
class Ecriture extends Eloquent {
	use ModelTrait;

	protected $guarded = array('id');
	protected $softDelete = true; // AFA


	public static function mutator() // aFa remove ?
	{
		return static::$mutatorCache;
	}

	protected $default_values_for_create = array(
		'banque_id' => 0,
		'date_valeur' => '2014-01-01',
		'date_emission' => '2014-01-01',
		'montant' => 0,
		'type_id' => 0,
		'libelle' => 'Saisir un libellé',
		'libelle_detail' => 'Compléter éventuellement le libellé',
		'justificatif' => INPUT_JUSTIF_TXT_DEFAUT,
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


	/* —————————  MUTATORS  —————————————————*/

	public function setMontantAttribute($value)
	{

		$value = F::montantFtoPhp($value);
		$this->attributes['montant'] = $value;
	}



	/* —————————  Créer un objet Ecriture pour le formulaire de création  —————————————————*/


}
