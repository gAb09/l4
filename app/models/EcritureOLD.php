<?php
class EcritureOLD extends Eloquent {

	protected static $unguarded = true; // AFA

	protected  $table = 'ecrituresOLD'; // AFA


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
		return $this->belongsTo('Banque', 'banque2_id');
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
	// public function getDates()
	// {
	// 	return array('created_at', 'updated_at', 'deleted_at', 'date_valeur', 'date_emission');
	// }


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

	// public function setDateEmissionAttribute($value)
	// {
	// 	if (isset($value)) {
	// 		$parts = explode('/', $value);
	// 		$this->attributes['date_emission'] = mktime(00, 00, 00, $parts[1], $parts[0], $parts[2]);
	// 	}
	// }

	// public function setDateValeurAttribute($value)
	// {
	// 	if (isset($value)) {
	// 		$parts = explode('/', $value);
	// 		$this->attributes['date_valeur'] = mktime(00, 00, 00, $parts[1], $parts[0], $parts[2]);
	// 	}
	// }


	/* —————————  Créer un objet Ecriture pour le formulaire de création  —————————————————*/

	public static function fillFormForCreate()
	{
		$ecriture = new Ecriture();
		$ecriture->attributes['date_valeur'] = '0000';
		$ecriture->attributes['date_emission'] = '0000';
		$ecriture->montant = 00;
		$ecriture->libelle = 'Saisir un libellé';
		$ecriture->libelle_detail = 'Éventuellement le compléter';
		$ecriture->type_id = 0;
		$ecriture->banque_id = 1;
		$ecriture->banque2_id = 0;
		$ecriture->compte_id = 0;
		return $ecriture;
	}


}
