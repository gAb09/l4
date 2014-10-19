<?php


/*
|--------------------------------------------------------------------------
| Section Grille
|--------------------------------------------------------------------------*/
Route::get('grille', function(){
	return View::make('frontend/views/layout');
});

Route::get('grille/emissions', function(){
	return View::make('grille/layout');
});

Route::get('grille/grille', function(){
	return View::make('grille/layout');
});

