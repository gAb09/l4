<?php

/* Classe de formatages des nombres */

class Nbre{

	public static function francais($nbre){
		$nbre = number_format($nbre, 2, ',', ' '); // renvoie 1 234,56
		return $nbre;
	}

	public static function francais_insec($nbre){
		$nbre = number_format($nbre, 2, ',', html_entity_decode("&nbsp;")); // renvoie 1 234,56
		return $nbre;
	}



	public static function sauv($value){
		$value = str_replace(' ', '', $value);
		$value = str_replace(',', '.', $value);
		return $value;
	}

}


	?>