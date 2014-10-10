<?php

class PointageRepo {
	public function Pointage($id)
	{

		$ecritures = Ecriture::with('signe', 'type', 'banque', 'statut', 'ecriture2')
		->where('banque_id', $id)
		->orderBy('date_emission')
		->get();

		if ($ecritures->isEmpty()){

			return false;
		}

		// Créer la propriété $mois_classement pour que la vue puisse classer par mois
		$ecritures->map(function($ecriture, $ecritures){
			$ecriture->mois_classement = \Date::classAnMois($ecriture->date_emission);
			return $ecritures;
		});

		return $ecritures;
	}

}