<?php

class EcritureRepository {

	private $prev_mois = 'premier';
	private $solde_dep = '';
	private $solde_rec = '';
	private $rang = 0;

	public function collectionCumulMois($id, $order)
	{
		$order = 'date_valeur';


		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'compte', 'ecriture2')
		->where('banque_id', $id)
		->orderBy($order)
		->get();

		if ($ecritures->isEmpty())
		{

			return false;
		}

		$nbre = $ecritures->count();

		$ecritures->each(function($ecriture) use ($order, $ecritures, $nbre) {
			/* Pour pouvoir accéder à l'écriture précédente
			on ajoute un attribut rang à chaque écriture.
			On lui affecte la valeur de la propriété $this-rang
			(initialisée à 0) que l'on incrémente ensuite */
			$ecriture->rang = $this->rang;
			$this->rang++;

			/* ----  Traitement du regroupement par mois ----- */

			/* A  Coder mois/année de classement */
			$ecriture->mois_classement = \Date::classAnMois($ecriture->{$order});

			/* B  Si il s'agit du premier mois de la page */
			if ($this->prev_mois == 'premier')
			{
				$ecriture->mois_nouveau = 'premier';
				/* C  Sinon, s'il y a changement de mois */
			}elseif($ecriture->mois_classement != $this->prev_mois)
			{
				$ecriture->mois_nouveau = 'nouveau';
				$prev_rang = $ecriture->rang -1;
				$ecritures[$prev_rang]->last = true;
			}

			/* D  Enfin, on conserve le mois de cette écriture 
			pour comparer avec l'écriture à suivre */
			$this->prev_mois = $ecriture->mois_classement;

			/* E  Et on n'oublie pas de qualifier la toute dernière écriture de last
			(Eh oui !!) */
			if ($ecriture->rang == ($nbre -1)) {
				$ecriture->last = true;
			}
			$this->prev_mois = $ecriture->mois_classement;


			/* ----- Traitement des soldes ----- */

			/* A   Si c'est la première ligne du mois on réinitialise les soldes */
			if($ecriture->mois_nouveau == 'nouveau')
			{
				$this->solde_dep = 0;
				$this->solde_rec = 0;
			}

			/* B   On calcule le solde à chaque ligne */
			if($ecriture->signe_id == 1){
				$this->solde_dep = $this->solde_dep + $ecriture->montant;
			}
			if($ecriture->signe_id == 2){
				$this->solde_rec = $this->solde_rec + $ecriture->montant;
			}

			/* C   On affecte les soldes à l'écriture */
			$ecriture->solde_dep = $this->solde_dep;
			$ecriture->solde_rec = $this->solde_rec;
			$ecriture->solde = $this->solde_rec - $this->solde_dep;
		});

		return $ecritures;

	}



	public function collectionCumulLigneEtMois($id, $order)
	{

		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'ecriture2')
		->where('banque_id', $id)
		->orderBy($order)
		->get();

		if ($ecritures->isEmpty()){

			return false;
		}

	// Créer la propriété $mois_classement pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures) use ($order) {
			$ecriture->mois_classement = \Date::classAnMois($ecriture->{$order});
			return $ecritures;
		});

		return $ecritures;
	}



	public function find($id)
	{
		return Ecriture::find($id);
	}


	public function save($ecriture)
	{
		$ecriture->save();
	}


}