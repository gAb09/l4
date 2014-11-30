<?php


/*
|--------------------------------------------------------------------------
| Section Grille
|--------------------------------------------------------------------------*/
Route::get('grille', function(){
	return View::make('grille/views/layout');
});

Route::get('grille/emissions', function(){
	return View::make('grille/views/layout');
});

Route::get('grille/grille', function(){
	return View::make('grille/views/layout');
});

