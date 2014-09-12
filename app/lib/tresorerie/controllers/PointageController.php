<?php
use lib\shared\Traits\IndexEcritures;

class PointageController extends BaseController {

	use IndexEcritures;

	private $order = 'date_emission';

	private $view = 'tresorerie.views.pointage.main';



}
