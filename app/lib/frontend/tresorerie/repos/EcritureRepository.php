<?php

class EcritureRepository {

	private $prev_mois = 'premier';
	private $solde_dep = '';
	private $solde_rec = '';
	private $rang = 0;

	public function collectionSoldeClasMois($id, $order, $periode = 'mois')
	{

		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'compte', 'ecriture2')
		->where('banque_id', $id)
		->orderBy($order)
		->get();

		if ($ecritures->isEmpty())
		{

			return false;
		}

		$ecritures->each(function($ecriture) use ($ecritures, $order, $periode) {

			$this->classementParMois($ecriture, $ecritures, $order);


			/* ----- Traitement des soldes ----- */

			/* Si nous sommes en période mensuelle 
			pour la première ligne du mois on réinitialise les soldes */
			if($periode == 'mois'){
				if($ecriture->mois_nouveau == 'nouveau')
				{
					$this->solde_dep = 0;
					$this->solde_rec = 0;
				}
			}
			/* On calcule le solde à chaque ligne */
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

	public function collectionPrev()
	{
		$order = 'date_valeur';

		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'compte', 'ecriture2')
		->orderBy($order)
		->get();

		if ($ecritures->isEmpty())
		{

			return false;
		}


		$ecritures->each(function($ecriture) use ($ecritures, $order) {

			/* ----  Traitement du regroupement par mois ----- */
			$this->classementParMois($ecriture, $ecritures, $order);


			/* ----- Traitement des soldes ----- */

			/* On calcule les soldes à chaque ligne */
			$this->solde_dep = $this->incrementeSoldeDepense($ecriture, $this->solde_dep);
			$this->solde_rec = $this->incrementeSoldeRecette($ecriture, $this->solde_rec);

			/* C   On affecte les soldes à l'écriture */
			$ecriture->solde_dep = $this->solde_dep;
			$ecriture->solde_rec = $this->solde_rec;
			$ecriture->solde = $this->solde_rec - $this->solde_dep;
		});

		return $ecritures;

	}

	private function classementParMois($ecriture, $ecritures, $order){

				/* Pour pouvoir accéder à l'écriture précédente
			on ajoute un attribut rang à chaque écriture.
			On lui affecte la valeur de la propriété $this-rang
			(initialisée à 0) que l'on incrémente ensuite */
			$ecriture->rang = $this->rang;
			$this->rang++;


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

			/* D  Et on n'oublie pas de qualifier la toute dernière écriture de last
			(Eh oui !!) */

			$nbre = $ecritures->count();

			if ($ecriture->rang == ($nbre -1)) {
				$ecriture->last = true;
			}

			/* E  Enfin, on conserve le mois de cette écriture 
			pour comparer avec l'écriture à suivre */
			$this->prev_mois = $ecriture->mois_classement;


		}

		private function incrementeSoldeRecette($ecriture, $solde){
			if($ecriture->signe_id == 2){
				$solde = $solde + $ecriture->montant;
			}
			return $solde;
		}
		private function incrementeSoldeDepense($ecriture, $solde){
			if($ecriture->signe_id == 1){
				$solde = $solde + $ecriture->montant;
			}
			return $solde;
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
