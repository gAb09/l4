<?php
$newss = Ecriture::all();
// $olds->date_emission = $news->date_emission;
foreach ($newss as $news) {
$i = $news->id;

	$dateemission = strftime('%Y-%m-%d %H:%M:%S', $news->date_emission); // renvoie 
	$datevaleur = strftime('%Y-%m-%d %H:%M:%S', $news->date_valeur); // renvoie 

$olds = EcritureOLD::find($news->id);

	$olds->date_emission = $dateemission;
	$olds->date_valeur = $datevaleur;

	// $olds->save();

	var_dump('date emission : ');
	var_dump($dateemission);
	var_dump($news->date_emission);
	var_dump($olds->date_emission);
	var_dump('date valeur : ');
	var_dump($datevaleur);
	var_dump($news->date_valeur);
	var_dump($olds->date_valeur);

}


?>