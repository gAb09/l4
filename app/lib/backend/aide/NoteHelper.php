<?php
class Notes
{
	public static function cleanPathNotes($path){

		$parties = explode('/', $path);

		foreach($parties as $partie)
		{
			if (is_numeric($partie)) {
				$assemblage[] = '*';
			}else{
				$assemblage[] = $partie;
			}
		}

		return implode('/', $assemblage);
	}
}
?>