<?php
use Baum\Node;

class Compte extends Node {
	/* Accès au listes pour input select */
	use ModelTrait;

	protected $guarded = array('id');


	/* —————————  RELATIONS  —————————————————*/

	public function ecriture()
	{
		return $this->hasMany('Ecriture');
	}

	/* —————————  SCOPES  —————————————————*/

	public static function scopeParentable()
	{
		$result = self::all(array('id', 'libelle', 'numero'));
		$items = $result->filter(function($item)
		{
			if (strlen($item->numero) < 6) {
				return $item;
			}
		});

		foreach($items as $item)
		{
			$list[$item->id] = '('.$item->numero.') '.$item->libelle;
		}
		return $list;
	}

	// public static function scopeFreres()
	// {
	// 	foreach(self::all(array('id', 'libelle', 'numero')) as $item)
	// 	{
	// 		$parent = Compte::where('id', Input::get('parent'))->first();
	// 		$freres = $parent->getImmediateDescendants();
	// 		$list[$item->id] = $item->numero.' : '.$item->libelle;
	// 	}
	// 	return $list;
	// }

	public static function scopeActif()
	{
		foreach(self::where('actif', '=', 1)->get(array('id', 'libelle')) as $item)
		{
			$list[$item->id] = $item->libelle;
		}
		return $list;
	}


	/* —————————  ACCESSORS  ————————————————— */

	public function getNumeroAttribute($value)
	{
		settype($value, 'string');
		return $value;
	}




	/* —————————  Créer un objet Compte pour le formulaire de création  ————————————————— */

	public static function fillFormForCreate()
	{
		$compte = new Compte();
		$compte->numero = 'Six chiffres max';
		$compte->libelle = 'Saisissez un libellé clair';
		$compte->description_officiel = '';
		$compte->actif = 0;
		return $compte;
	}
}