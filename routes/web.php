<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('import', 'GenreController@import');
Route::post('import', 'FilmController@import');

Route::get('export', 'GenreController@export');
Route::get('export', 'FilmController@export');

Route::resource('/genre', 'GenreController');
Route::resource('/penyimpanan', 'PenyimpananController');
Route::resource('/cancel', 'CancelController');
Route::resource('/pelanggan', 'PelangganController');
Route::resource('/film', 'FilmController');
Route::resource('/order', 'OrderController');
Route::resource('/orderdetail', 'OrderdetailController');
Route::resource('/accounting', 'AccountingController');
Route::resource('/situs', 'SitusController');

Route::post('/get_penyimpanan', 'PenyimpananController@get_penyimpanan')->name('penyimpanan.get_penyimpanan');
Route::post('/get_pelanggan', 'PelangganController@get_pelanggan')->name('pelanggan.get_pelanggan');
Route::post('/get_genre', 'GenreController@get_genre')->name('genre.get_genre');
Route::post('/get_film', 'FilmController@get_film')->name('film.get_film');
Route::post('/cari_film', 'FilmController@cari_film')->name('film.cari_film');

Route::post('pindah', 'FilmController@pindah')->name('film.pindah');