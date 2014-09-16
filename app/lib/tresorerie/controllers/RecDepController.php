<?php
use lib\shared\Traits\IndexEcritures;

class RecDepController extends BaseController {

	use IndexEcritures;

	private $order = 'date_emission';

	private $view = 'tresorerie.views.recdep.main';


}