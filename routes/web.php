<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'welcomeController@index')->name('home');
Route::view('about', 'frontend.about')->name('about');
Route::view('contact', 'frontend.contact')->name('contact');




Route::middleware(['auth:sanctum', 'user'])->group(function(){
	Route::get('ask/question/new', 'AskQuestionController@index')->name('askquestion.index');
	Route::post('ask/question/new', 'AskQuestionController@store')->name('askquestion.store');
	Route::view('my-profile', 'frontend.myprofile')->name('myprofile.show');
});


Route::middleware(['auth:sanctum','admin'])->prefix('admin')->group(function(){
	Route::get('/','AdminDashboardController@index');
	Route::get('dashboard','AdminDashboardController@index')->name('dashboard');

	//Template Routes
	Route::view('/buttons','template.buttons')->name('template.button');
	Route::view('/cards','template.cards')->name('template.cards');
	Route::view('/colors','template.colors')->name('template.colors');
	Route::view('/borders','template.borders')->name('template.borders');
	Route::view('/animations','template.animations')->name('template.animations');
	Route::view('/others','template.others')->name('template.others');
	Route::view('/login','template.login')->name('template.login');
	Route::view('/register','template.register')->name('template.register');
	Route::view('/forget-password','template.forget-password')->name('template.forget-password');
	Route::view('/404','template.404')->name('template.404');
	Route::view('/blank','template.blank')->name('template.blank');
	Route::view('/charts','template.charts')->name('template.charts');
	Route::view('/tables','template.tables')->name('template.tables');
});