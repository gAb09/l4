<?php
namespace lib\shared\Traits;

trait TraitRepository {

	private $rang = 0;

	private $prev_mois = 'premier';

	private $solde_dep = '';

	private $solde_rec = '';

	/**
	 * Prépare l'affichage des lignes en tableaux d'un même mois/année.
	 *
	 * @param $ligne. La ligne du tableau en cours de traitement.
	 * @param $collection.
	 * @param $order. Le critère pour l'ordre de classement.
	 * @param $last. Le critère pour l'ordre de classement.
	 *
	 * @return Rien puisque appellée depuis une boucle each sur une collection
	 *
	 */
	private function classementParMois($ligne, $collection, $order, $last){

			/* Pour pouvoir accéder depuis une ligne à la ligne précédente :
			Ajouter un attribut rang à chaque ligne.

			/* Affecter la valeur de la propriété $this-rang initialisée à 0. */
			$ligne->rang = $this->rang;

			/* Incrémenter pour la ligne suivante */
			$this->rang++;


			/* Extraire le mois et l’année du critère de classement */
			$ligne->mois_classement = \Date::classAnMois($ligne->{$order});

			/* Il s'agit du premier mois de la page ?
			Assigner $mois_nouveau de cette ligne à "premier"*/
			if ($this->prev_mois == 'premier')
			{
				$ligne->mois_nouveau = 'premier';

				/* Il y a changement de mois ? */
			}elseif($ligne->mois_classement != $this->prev_mois)
			{
				/* Assigner $mois_nouveau de cette ligne à "nouveau" */
				$ligne->mois_nouveau = 'nouveau';
				$prev_rang = $ligne->rang -1;
				/* Assigner $last de la ligne précédente à "true" */
				$collection[$prev_rang]->last = true;
			}

			/* On n'oublie pas la toute dernière ligne de la page.*/
			if ($ligne->rang == $last) {
				$ligne->last = true;
			}

			/* E  Enfin, on passe le mois de classement de cette ligne 
			dans $prev_mois pour comparaison avec la ligne suivante */
			$this->prev_mois = $ligne->mois_classement;


		}

















	/**
	 * Prépare l'affichage des lignes en tableaux d'un même mois/année.
	 *
	 * @param $ligne. La ligne du tableau en cours de traitement.
	 * @param $collection.
	 * @param $order. Le critère pour l'ordre de classement.
	 * @param $last. Le critère pour l'ordre de classement.
	 *
	 * @return Rien puisque appellée depuis une boucle each sur une collection
	 *
	 */
	private function getSoldes($ligne, $collection, $order, $periode, $last){
			/* Si nous sommes en soldes mensuels,
			réinitialiser les soldes pour la première ligne du mois  */
			if($periode == 'mois'){
				if($ligne->mois_nouveau == 'nouveau')
				{
					$this->solde_dep = 0;
					$this->solde_rec = 0;
				}
			}

			/* Calculer le solde à chaque ligne */
			if($ligne->signe_id == 1){
				$this->solde_dep = $this->solde_dep + $ligne->montant;
			}
			if($ligne->signe_id == 2){
				$this->solde_rec = $this->solde_rec + $ligne->montant;
			}

			/* C   On affecte les soldes à l'écriture */
			$ligne->solde_dep = $this->solde_dep;
			$ligne->solde_rec = $this->solde_rec;
			$ligne->solde = $this->solde_rec - $this->solde_dep;

		}












	/**
	 * Prépare l'affichage des lignes en tableaux d'un même mois/année.
	 *
	 * @param $ligne. La ligne du tableau en cours de traitement.
	 *
	 * @return Rien puisque appellée depuis une boucle each sur une collection
	 *
	 */
	private function incrementeSoldeRecette($ligne, $solde){
		if($ligne->signe_id == 2){
			$solde = $solde + $ligne->montant;
		}
		return $solde;
	}
	private function incrementeSoldeDepense($ligne, $solde){
		if($ligne->signe_id == 1){
			$solde = $solde + $ligne->montant;
		}
		return $solde;
	}




}
