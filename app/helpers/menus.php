<?php

/*
|--------------------------------------------------------------------------
| Les menus
|--------------------------------------------------------------------------
|
*/
Session::put('section.compta', array(
	'nom' => 'compta', 
	'etiquette' => 'Comptabilité',
	'sousmenu' => array(

		'recettes_depenses' => array(
			'nom' => 'rec_dep',
			'etiquette' => 'Recettes/Dépenses',
			),

		'pointage' => array(
			'nom' => 'pointage/banque',
			'etiquette' => 'Pointage',
			),

		'previsionnel' => array(
			'nom' => 'previsionnel',
			'etiquette' => 'Prévisionnel',
			),
		
		'ecritures' => array(
			'nom' => 'ecritures',
			'etiquette' => 'Écritures',
			),
		
		'types' => array(
			'nom' => 'types',
			'etiquette' => 'Types',
			),
		
		'banques' => array(
			'nom' => 'banques',
			'etiquette' => 'Banques',
			),
		
		'comptes' => array(
			'nom' => 'comptes',
			'etiquette' => 'Comptes',
			),
		
		)
	)
);

Session::put('section.grille', array(
	'nom' => 'grille', 
	'etiquette' => 'Grille',
	'sousmenu' => array(

		'grille' => array(
			'nom' => 'grille',
			'etiquette' => 'Grille',
			),

		'emissions' => array(
			'nom' => 'emissions',
			'etiquette' => 'Émissions',
			),
		
		)
	)
);

	Session::put('section.menu', array(
		'nom' => 'menu', 
		'etiquette' => 'Menus',
		'sousmenu' => array(

			'racines' => array(
				'nom' => 'racines',
				'etiquette' => 'Racines',
				),

			'emissions' => array(
				'nom' => 'items',
				'etiquette' => 'Items',
				),
			
			)
		)
	);
