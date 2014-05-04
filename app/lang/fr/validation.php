<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	// Le champ sous validation doit être yes, on, ou 1. Ceci est utile pour tester l’acceptation des Conditions Générales d’utilisation ou de vente par exemple.
	"accepted"         => ":attribute doit être accepté.", 
	// Le champ sous validation doit être une URL valide selon la fonction PHP checkdnsrr
	"active_url"       => ":attribute n’est pas une URL valide.",
	"after"            => ":attribute doit être une date postérieure à :date.",
	"alpha"            => ":attribute ne peut contenir que des letres.",
	"alpha_dash"       => ":attribute ne peut contenir que des lettres, des chiffres, des tirets (-) ou underscores (_).",
	"alpha_num"        => ":attribute ne peut contenir que des lettres et des chiffres.",
	"array"            => ":attribute doit être un tableau.",
	"before"           => ":attribute doit être une date antérieure à :date.",
	"between"          => array(
		"numeric" => ":attribute doit être compris entre :min et :max.",
		"file"    => ":attribute doit être compris entre :min et :max kilobytes.",
		"string"  => ":attribute doit être compris entre :min et :max caractères.",
		"array"   => ":attribute must have compris entre :min et :max items.",
		),
	"confirmed"        => "Problème lors de la confirmation de :attribute.",
	"date"             => "La date fournie pour :attribute n’est pas reconnue.",
	"date_format"      => "Le format de date attendu pour :attribute n’est pas respecté.",
	"different"        => ":attribute et :other doivent être differents.",
	"digits"           => ":attribute doit être :digits digits.",
	"digits_between"   => ":attribute doit être compris entre :min et :max digits.",
	"email"            => "Le format de :attribute est incorrect.",
	// Le champ sous validation doit exister dans la base de données.
	"exists"           => ":attribute n’a pas été trouvé.",
	"image"            => ":attribute doit être une image.",
	"in"               => ":attribute ne correspond à aucune des valeurs autorisées.",
	"integer"          => ":attribute doit être un intégré (numérique).",
	"ip"               => ":attribute doit être une adresse IP correcte.",
	"max"              => array(
		"numeric" => ":attribute ne peut être supérieur à :max.",
		"file"    => ":attribute ne peut être supérieur à :max kilobytes.",
		"string"  => ":attribute ne peut être supérieur à :max caractères.",
		"array"   => ":attribute ne peut contenir plus de :max items.",
		),
	"mimes"            => ":attribute doit être un fichier du type: :values.",
	"min"              => array(
		"numeric" => ":attribute doit être supérieur à :min.",
		"file"    => ":attribute doit être supérieur à :min kilobytes.",
		"string"  => ":attribute doit être supérieur à :min caractères.",
		"array"   => ":attribute doit contenir au moins :min items.",
		),
	"not_in"           => "Le champ “:attribute” contient une valeur non autorisée.",
	"numeric"          => ":attribute doit être du type numérique.",
	"regex"            => "Le format de :attribute est incorrect.",
	"required"         => "Le champ :attribute doit être renseigné.",
	"required_if"      => "Le champ :attribute doit être renseigné lorsque :other vaut :value.",
	"required_with"    => "Le champ :attribute doit être renseigné lorsque :values est (sont) renseigné(s).",
	"required_without" => "Le champ :attribute doit être renseigné lorsque :values ne l’est (le sont) pas.",
	"same"             => ":attribute et :other sont différents.",
	"size"             => array(
		"numeric" => ":attribute doit faire :size.",
		"file"    => ":attribute doit faire :size kilobytes.",
		"string"  => ":attribute doit contenir :size caractères.",
		"array"   => ":attribute doit contenir :size items.",
		),
	"unique"           => "La valeur proposée pour le champ ':attribute' existe déjà.",
	"url"              => "Le format de :attribute est incorrect.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
		'nom' => 'Nom',
		'description' => 'Description',
		),
	);