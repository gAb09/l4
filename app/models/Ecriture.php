<?php
class Ecriture extends Eloquent {

	protected static $unguarded = true; // AFA


	/* —————————  RELATIONS  —————————————————*/

	public function type()
	{
		return $this->belongsTo('Type');
	}

	public static function mutator() // aFa remove ?
	{
		return static::$mutatorCache;
	}

	public function compte()
	{
		return $this->belongsTo('Compte');
	}

	public function banque()
	{
		return $this->belongsTo('Banque');
	}

	public function banque2()
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
		$value = str_replace(' ', '', $value);
		$this->attributes['montant'] = str_replace(',', '.', $value);
	}


	public function setBanque2IdAttribute($value)
	{
		$result = ($value == 0) ? null : $value ;
		$this->attributes['banque2_id'] = $result;
	}


	/* —————————  Créer un objet Ecriture pour le formulaire de création  —————————————————*/

	public static function fillFormForCreate()
	{
		$ecriture = new Ecriture();
		$ecriture->banque_id = 0;
		$ecriture->attributes['date_valeur'] = '0000';
		$ecriture->attributes['date_emission'] = '0000';
		$ecriture->montant = 00;
		$ecriture->type_id = 0;
		$ecriture->libelle = 'Saisir un libellé';
		$ecriture->libelle_detail = 'Éventuellement le compléter';
		$ecriture->justificatif = 'Éventuellement préciser un justificatif';
		$ecriture->compte_id = 0;
		$ecriture->double_flag = false;
		return $ecriture;
	}


}
