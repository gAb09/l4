<?php

class Compte extends Eloquent {

	protected static $unguarded = true; // AFA

	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}

	/* —————————  Liste pour input select  —————————————————*/

	public static function listForInputSelect()
	{
		$list[0] = 'Faire une sélection';
		foreach(static::all() as $item)
		{
			$list[$item->id] = $item->numero.' - '.$item->libelle;
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
		$compte->description_comp = 'Écrire ici pour apporter des informations complémentaires sur l’utilisation officielle de ce compte.';
		$compte->description_lmh = 'Écrire ici pour définir les modalités d’utilisation de ce compte spécifique à La Mauvaise Herbe.';
		$compte->lmh = 1;
		$compte->actif = 1;
		return $compte;
	}


}
