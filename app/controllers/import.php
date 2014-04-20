<?php

if(is_file("comptes.txt")) { echo "Le fichier existe"; }else { echo "Le fichier n'existe pas"; } 


echo '<br />repertoire : '.basename(dirname(__FILE__)); 

$handle = fopen("oui.txt", "w");

//fwrite($handle, "Écriture, dans, le fichier, temporaire\nghghgh gh,jhhjhj,hjgfdtfu");
echo '<br /> handle : ';
var_dump($handle);
$tableau = file("oui.txt");
echo '<br /> tableau : ';var_dump($tableau);

//$result = fgetcsv($handle);
//echo '<br /> result : ';var_dump($result);
//fclose($handle);
echo '<br /> file_get_contents : '.file_get_contents("oui.txt");
echo '<br />'.sys_get_temp_dir() ;
echo '<br />page lue';
?>