<?php
use lib\shared\Traits\IndexEcritures;

class PrevController extends BaseController {

	use IndexEcritures;

	// Le critère de classement
	private $order = 'date_valeur';

	// La vue appelée
	private $view = 'tresorerie.views.prev.main';

	// Le tableau des statuts modifiables depuis cette page
	private $statuts_ok = '1-2';


}