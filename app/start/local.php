<?php

Session::set('site', 'Trésorerie de La Locale');

/*
|--------------------------------------------------------------------------
| Désactiver la debugbar
|-------------------------------------------------------------------------- */
// \Debugbar::disable();


/*
|--------------------------------------------------------------------------
| Ecouter toutes les créations faites par l'IoC
|-------------------------------------------------------------------------- */

// App::resolvingAny(function($object)
// {
// 	echo '<h2>'.get_class($object)."</h2>";
//     var_dump(get_object_vars($object));
//     echo '<h5>method</h5>';
//     var_dump(get_class_methods($object));
     
// });