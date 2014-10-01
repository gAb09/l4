<?php

class Note extends Eloquent {

protected static $unguarded = true; // AFA
public $timestamps = false; // AFA

/* —————————  RELATIONS  —————————————————*/


/* —————————  Liste pour input select  —————————————————*/

public static function listForInputSelect()
{
}

/* —————————  Créer un objet note pour le formulaire de création  —————————————————*/

public static function fillFormForCreate()
{
}

}
