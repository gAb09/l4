<?php
use Baum\Node;

class Compte extends Node {
	/* Accès au listes pour input select */
	use ModelTrait;

	// protected $guarded = array(); // AFA 


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


	public static function scopeRoots()
	{
		$roots = Compte::where('parent', '=', 0)->orderBy('numero')->get();
		return $roots;
	}

	public static function scopeImmChildren($parent)
	{
		$children = Compte::where('parent', '=', $parent)->orderBy('numero')->get();
		return $children;
	}

/* 
Recupérer les roots
	Each Root :
	Stocker root
	Get children1
		Each child1
		Stocker child1
		Get children
 */

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
