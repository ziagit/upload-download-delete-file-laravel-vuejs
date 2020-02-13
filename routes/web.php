<?php



Auth::routes();

Route::get('/', 'HomeController@index');
/* Route::get('/welcome', 'FileController@index');
Route::post('upload', 'FileController@uploadFile');
Route::get('download/upload/{file}', 'FileController@downloadFile');
Route::get('delete/upload/{file}', 'FileController@deleteFile');
 */
