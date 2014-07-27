<?php

/* Classe de formatages des nombres et dates */

class F{

// Les nombres
	public static function nbre($nbre){
		$nbre = number_format($nbre, 2, ',', ' '); // renvoie 1 234,56
		return $nbre;
	}

	public static function nbre_insec($nbre){
		$nbre = number_format($nbre, 2, ',', html_entity_decode("&nbsp;")); // renvoie 1 234,56
		return $nbre;
	}





	public static function montantFtoPhp($value){
		$value = str_replace(' ', '', $value);
		$value = str_replace(',', '.', $value);
		return $value;
	}

}


	?>