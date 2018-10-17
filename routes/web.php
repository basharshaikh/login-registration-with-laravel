<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//for registration and get method
Route::get('/signup', [ //for my version
	'as' => 'register',
	'uses' => 'HomeController@viewRegisterForm'
]);

//for registration and post method
Route::post('/signup', [ //for my version
	'as' => 'register',
	'uses' => 'HomeController@proccessRegistration'
]);
//for registration
//for latest version
// Route::name('register')->get('/signup', 'HomeController@viewRegisterForm');




//for login
Route::name('login')->get('/login', 'HomeController@viewLoginForm');
Route::name('login')->post('/login', 'HomeController@processLogin');
Route::name('activation')->get('/activate/{token}', 'HomeController@proccessActivation');
Route::name('forgot-password')->get('/forgot', 'HomeController@viewForgotForm');
Route::name('forgot-password')->post('/forgot', 'HomeController@processForgot');


//for athorization
Route::group(['middleware' => 'auth'], function () {
    Route::name('dashboard')->get('/dashboard', 'HomeController@viewDashboard');
    Route::name('logout')->get('/logout', 'HomeController@logout');
});