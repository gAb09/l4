<?php

class Import extends Eloquent {

	protected $fillable = array('*');






	/* —————————  DATES  —————————————————*/
	public function getDates()
	{
		return array('created_at', 'updated_at', 'deleted_at', 'date_valeur', 'date_emission');
	}


	/* —————————  ACCESSORS  —————————————————*/
	public function getMontantAttribute($value)
	{
		
		return (double) $value;
	}



	/* —————————  MUTATORS  —————————————————*/

	public function setMontantAttribute($value)
	{

		$value = NombresFr::sauv($value);
		$this->attributes['montant'] = $value;
	}

}
