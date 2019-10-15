<?php
Route::get('/', 'HomeController@home');
Route::post('/', 'HomeController@generateShortlink');

Route::get('/banner', 'HomeController@banner');

Route::get('/{shortlink}', ['uses' =>'HomeController@shortlinkRedirect']);

