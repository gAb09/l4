<?php


class Volets
{
	
	/* 
	**
	** 
	** 
	** 
	*/
	public static function getMoisCourant(){

		if( $mois = Session::get('Courant.mois') ){
			return $mois;
		}else{
			return"";
		}
	}

}
?>