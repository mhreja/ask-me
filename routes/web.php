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


Route::get('/', 'WelcomeController@index')->name('home');
Route::view('about', 'frontend.about')->name('about');
Route::view('contact', 'frontend.contact')->name('contact');


Route::middleware(['auth:sanctum', 'user'])->group(function(){
	Route::get('ask/question/new', 'AskQuestionController@index')->name('askquestion.index');
	Route::post('ask/question/new', 'AskQuestionController@store')->name('askquestion.store');
	Route::view('my-profile', 'frontend.myprofile')->name('myprofile.show');
});



//Admin Panel
Route::middleware(['auth:sanctum','admin'])->prefix('admin')->group(function(){
	Route::get('/','AdminDashboardController@index');
	Route::get('dashboard','AdminDashboardController@index')->name('dashboard');

	Route::view('subjects', 'admin.Subjects.index')->name('subjects');
	Route::resource('topics', 'TopicsController');

	
});