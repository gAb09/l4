<?php
use lib\shared\Traits\IndexEcritures;

class RecDepController extends BaseController {

	use IndexEcritures;

	// Le critère de classement
	private $order = 'date_emission';

	// La vue appelée
	private $view = 'tresorerie.views.recdep.main';

	// Le tableau des statuts modifiables depuis cette page
	private $statuts_ok = '1-2';


}