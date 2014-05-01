<?php

/* Classe de formatages des nombres et dates */

class F{

// Les nombres
	public static function nbre($nbre){
		return number_format($nbre, 2, ',', ' '); // renvoie 1 234,56
	}

// Les dates

	/* e b Y  séparateur nbspace => 15 déc 1960
	**
	** Date courte
	*/
	public static function dateCourteNb($date){
		return $date->formatlocalized('%e&nbsp%b&nbsp%Y');
		// return strftime('%e&nbsp%b&nbsp%Y', $date); // renvoie 
	}

	/* Y m Séparateur tiret => 1960-12
	**
	** Pour permettre classement par mois années
	*/
	public static function dateClass($date){
		return $date->formatlocalized('%Y-%m');
		// return strftime('%Y-%m', $date);
	}

	/* B Y Séparateur nbspace => décembre 1960
	** Rajout de la majuscule au mois
	**
	** Affichage en tétière de récapitulatif par mois
	*/
	public static function dateUcMoisAnneeNb($date){
		return ucfirst($date->formatlocalized('%B&nbsp%Y'));
		// return ucfirst(strftime('%B&nbsp%Y', $date));
	}

	/* d m Y Séparateur / => 15/12/1960
	**
	** Pour saisie dans les formulaires
	*/
	public static function dateSaisie($date){
		return $date->formatlocalized('%d-%m-%Y');
	}

	public static function dateSaisieSauv($date){
		$parties = explode('-', $date);

		return $parties[2].'-'.$parties[1].'-'.$parties[0].' 00:00:00';
	// 	return ucfirst(strftime('%d/%m/%Y', $date));
	}



}

	/* d
	** Jour du mois en numérique, sur 2 chiffres (avec le zéro initial).
	** De 01 à 31
	*/

	/* e
	** Jour du mois, avec un espace précédant le premier chiffre.
	** De 1 à 31
	*/

	/* B
	** Nom du mois, complet, suivant la locale.
	** De janvier à décembre.
	*/

	/* b
	** Nom du mois, abrégé, suivant la locale.
	** De jan à déc.
	*/

	/* m
	** Mois, sur 2 chiffres.
	** De 01 (pour Janvier) à 12 (pour Décembre).
	*/

	/* Y
	** L’année, sur 4 chiffres.
	** Exemple : 2038
	*/

?>