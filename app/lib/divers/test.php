<?php
		// Récupérer la collection d'écriture pour la banque demandée
		$statuts = Statut::where('rang', 3)
		->get()
		;
		foreach ($statuts as $statut) {
			# code...
		}
$ecritures = 
var_dump($ecritures);


foreach ($ecritures as $ecriture) {
	var_dump($ecriture);
	echo "<hr />";
}


// foreach ($ecritures as $key => $value) {
// 	var_dump($key);
// 	var_dump($value);
// 	echo "<hr />";
// }
