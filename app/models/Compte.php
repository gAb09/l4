<?php

class Compte extends Eloquent {
	use ModelTrait;

	protected static $unguarded = true; // AFA


	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}


	/* —————————  SCOPES  —————————————————*/

	public static function scopeactif()
	{
		// dd(static::where('actif', '=', 1)->toSql());
		foreach(static::where('actif', '=', 1)->get(['id', 'libelle']) as $item)
		{
			$list[$item->id] = $item->libelle;
		}
		return $list;
	}


	/* —————————  Créer un objet Compte pour le formulaire de création  —————————————————*/

	public static function fillFormForCreate()
	{
		$compte = new Compte();
		$compte->numero = '6 chiffres max';
		$compte->libelle = 'Saisissez un libellé clair';
		$compte->description_officiel = '';
		$compte->lmh = 0;
		$compte->actif = 0;
		return $compte;
	}


}
