<?php

class StatutRepository {
	
	public function classeStatutSelonId(){
		$results = Statut::all(['id', 'classe']);
		foreach ($results as $result) {
			$classe_statut_selon_id[$result->id] = $result->classe;
		}
		return json_encode($classe_statut_selon_id);
	}


	public function incremente($statuts_accessibles, $ecriture)
	{
		$last_statut_accessible = substr($statuts_accessibles, -1);
		$statut_actuel = ($ecriture->statut_id);

		$new_statut = ($statut_actuel < $last_statut_accessible) ? ++$statut_actuel : $statuts_accessibles[0] ;

		return $new_statut;
	}

}