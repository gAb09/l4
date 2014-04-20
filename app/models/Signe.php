<?php

class Signe extends Eloquent {

	protected static $unguarded = true; // AFA

	/* —————————  RELATIONS  —————————————————*/

public function ecriture()
{
	return $this->hasMany('Ecriture');
}


	/* —————————  ACCESSORS  —————————————————*/



	/* —————————  MUTATORS  —————————————————*/


	/* —————————  Liste de sélection  —————————————————*/

	public static function listForInputRadio($signe_ecriture)
	{
		foreach(static::all() as $item)
		{
			$signes[$item->id]['name'] = 'signe';
			$signes[$item->id]['value'] = $item->id;
			$signes[$item->id]['checked'] = ($signe_ecriture == $item->id) ? true : false ;
			$signes[$item->id]['etiquette'] = $item->etiquette;
			$signes[$item->id]['id_css'] = 'signe_'.$item->id;
			$signes[$item->id]['fonction_js'] = $item->etiquette.'();';
		}
		return $signes;

	}


}