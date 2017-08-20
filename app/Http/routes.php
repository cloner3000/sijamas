<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('profile', 'ProfileController@index');
Route::get('usulan-kerjasama', 'UsulanController@index');
Route::get('kategori-kerjasama', 'KategoriController@index');
Route::get('kategori-kerjasama/read/{id?}', 'KategoriController@read');
Route::get('kontak-kami', 'KontakController@index');

Route::controller('usulan-kerjasama','UsulanController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


// Route::group(['middleware' => ['web']], function () {
    
	Route::controller('login','Backend\LoginController');

	Route::get('admin-cp' , function(){
		return redirect('login');
	});

	if(\Request::segment(1) == trinata()->backendUrl)
	{
		include __DIR__.'/backendRoutes.php';
	}

// });