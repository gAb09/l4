<?php
use lib\shared\Traits\TraitRepository;

class PrevRepository {
	use TraitRepository;

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

		$banques = Banque::isPrevisionnel();
		$this->solde = array();
		foreach ($banques as $bank) {
			$this->solde[$bank->id] = 0;
		}
		$this->solde['total'] = 0;




		$ecritures->each(function($ecriture) use ($ecritures, $order, $banques) {

			/* ----  Traitement du regroupement par mois ----- */
			$this->classementParMois($ecriture, $ecritures, $order, 'mois');


			/* ----- Traitement des soldes par banques ----- */

			/* On récupère la liste des banques à afficher */
			// var_dump($ecriture->libelle);
			// var_dump($ecriture->montant);

			foreach ($banques as $bank) {
				$bank_id = $bank->id;
				$ecriture->montant = $ecriture->montant * $ecriture->signe->signe;
				/* On initialise tout les soldes */
				// echo 'bank_id : ';var_dump($bank_id);
				// var_dump($ecriture->banque_id);

				/* On calcule les soldes de chaque banque à chaque ligne  */
				if($ecriture->banque_id == $bank_id){
					// var_dump('ok');
					$this->solde[$bank_id] = $this->solde[$bank_id] + $ecriture->montant;
					$this->solde['total'] = $this->solde['total'] + $ecriture->montant;



					/*  On affecte les soldes à l'écriture */
					$index = 'solde_'.$bank->id;
					$ecriture->$index = $this->solde[$bank_id];
					$ecriture->solde_total = $this->solde['total'];
				}
				// var_dump($this->solde);
				// var_dump('----------------------------------------------------------------');
			}

		});
	// dd('fin');
	return $ecritures;

	}

}