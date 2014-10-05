<?php


/**
* Classe de gestion des dates
*/
class Date
{
	
	/* Date courte insécable
	**
	** return 15 décembre 1960 (espaces insécables)
	** e B Y 
	** 2 séparateurs = nbspace 
	*/
	public static function courte(Carbon\Carbon $date){
		return $date->formatlocalized('%e&nbsp%B&nbsp%Y');
	}

	/* Date courte sécable
	**
	** return 15 décembre 1960 (espaces sécables)
	** e B Y 
	** 2 séparateurs = space 
	*/
	public static function courteSec(Carbon\Carbon $date){
		return $date->formatlocalized('%e %B %Y');
	}

	/* Pour permettre classement des écritures par années puis mois
	**
	** return 1960-12
	** Y m 
	** Séparateur = tiret
	*/
	public static function classAnMois(Carbon\Carbon $date){
		return $date->formatlocalized('%Y.%m');
	}

	/* Mois année (Affichage en tétière de récapitulatif par mois)
	**
	** return décembre 1960
	** B Y
	** Séparateur = nbspace
	*/
	public static function MoisAnneeInsec(Carbon\Carbon $date){
		return ucfirst($date->formatlocalized('%B&nbsp%Y'));
	}

	/* Pour saisie dans les formulaires
	**
	** return 15-12-1960
	** d m Y 
	** Séparateur = tiret
	*/
	public static function formEdit(Carbon\Carbon $date){
		return $date->formatlocalized('%d-%m-%Y');
	}

	/* Pour sauvegarde
	**
	** return 15-12-1960
	** d m Y 
	** Séparateur = tiret
	*/
	public static function Sauv($date){
		if ($test = substr_count($date, '-') == 2) {
			$parties = explode('-', $date);
			return $parties[2].'-'.$parties[1].'-'.$parties[0].' 00:00:00';
		}
	}

	/* Pour Affichage du mois en cours d'édition
	**
	** return décembre 1960
	** B Y
	** Séparateur = nbspace
	*/
	public static function MoisEdit($string){
		if (substr_count($string, '.') == 1) {
			$parties = explode('.', $string);

			// dd($date = $parties[0].', '.$parties[1].', 01, 00, 00, 00');
			$date =  Carbon\Carbon::create($parties[0], $parties[1], 01, 00 ,00, 00);
			return self::MoisAnneeInsec($date);		}
		}

// – – – – – – – – – –  Constantes php pour les dates – – – – – – – – – – – – – – 
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

}
?>