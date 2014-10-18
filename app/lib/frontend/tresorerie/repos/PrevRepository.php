<?php
use lib\shared\Traits\TraitRepository;

class PrevRepository {
	use TraitRepository;

	private $tampon = array();

	private $rang = 0;

	public function collectionPrev($banques)
	{
		$order = 'date_valeur';

		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'compte', 'ecriture2')
		->orderBy($order)
		->get();

		if ($ecritures->isEmpty())
		{

			return false;
		}

		$this->solde = array();
		foreach ($banques as $bank) {
			$this->solde[$bank->id] = 0;
		}
		$this->solde['total'] = 0;




		$ecritures->each(function($ecriture) use ($ecritures, $order, $banques) {

			/* Affecter la valeur de la propriété $this-rang initialisée à 0. */
			$ecriture->rang = $this->rang;

			/* Incrémenter pour la ligne suivante */
			$this->rang++;


			/* ----  Traitement du regroupement par mois ----- */
			$this->classementParMois($ecriture, $ecritures, $order, 'mois');

			/* ----- Traitement des soldes par banques ----- */

			/* On récupère la liste des banques à afficher */
			$ecriture->montant = $ecriture->montant * $ecriture->signe->signe;

			foreach ($banques as $bank) {

				/* On calcule les soldes de chaque banque à chaque ligne
				Attention le calcul est différent s'il s'agit d'une écriture double ou simple */
				if($ecriture->banque_id == $bank->id){

					if ($ecriture->double_flag != 1) {
						$this->solde[$bank->id] +=  $ecriture->montant;
						$this->solde['total'] += $ecriture->montant;

						/*  On affecte les soldes à l'écriture */
						$ecriture->{'solde_'.$bank->id} = $this->solde[$bank->id];
						$ecriture->solde_total = $this->solde['total'];

					}

					if ($ecriture->double_flag == 1)
					{
						if (!array_key_exists($ecriture->id, $this->tampon))
						{
							$this->tampon[$ecriture->double_id] = [
							'bank2_id' => $ecriture->banque_id,
							'montant' => $ecriture->montant,
							'signe' => $ecriture->signe->signe,
							];
							unset($ecritures[$ecriture->rang]);

						}else{
							$tampon = $this->tampon[$ecriture->id];
							$this->solde[$bank->id] = $this->solde[$bank->id] + $ecriture->montant;
							$solde2 = $this->solde[$tampon['bank2_id']];
							$solde2 = $solde2 + ($ecriture->montant * -1);

							/*  On affecte les soldes à l'écriture */
							$ecriture->{'solde_'.$bank->id} = $this->solde[$bank->id];
							$ecriture->{'solde_'.$tampon['bank2_id']} = $solde2;
							$ecriture->solde_total = $this->solde['total'];
						}
					}				
				}

				// var_dump($ecriture);
				// var_dump('----------------------------------------------------------------');
			}

		});
				// dd($ecritures);

// dd('fin');
return $ecritures;

}

}