<?php

class EcritureRepository {

	public function collection($id, $order)
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