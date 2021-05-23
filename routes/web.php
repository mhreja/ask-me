<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'WelcomeController@index')->name('home');
Route::view('about', 'frontend.about')->name('about');
Route::view('contact', 'frontend.contact')->name('contact');

//Questions
Route::get('questions/recent', 'WelcomeController@recentquestions')->name('recentquestions');
Route::get('questions/popular', 'WelcomeController@popularquestions')->name('popularquestions');
Route::get('questions/most-answered', 'WelcomeController@mostansweredquestions')->name('mostansweredquestions');
Route::get('questions/not-answered', 'WelcomeController@notansweredquestions')->name('notansweredquestions');

//Subject Question
Route::get('questions/subject/{subject}', 'WelcomeController@subjectQuestions')->name('subjectQuestions');

//Topic Question
Route::get('questions/topic/{topic}', 'WelcomeController@topicQuestions')->name('topicQuestions');

//Searched Question
Route::get('questions/search', 'WelcomeController@searchedQuestions')->name('searchedQuestions');

//Question Inner Page
Route::get('question/{question}', 'WelcomeController@questionInner')->name('questionInner');


Route::middleware(['auth:sanctum', 'user'])->group(function(){
	//Mini Ask Now
	Route::post('ask/question', 'AskQuestionController@miniask')->name('askquestion.miniask');

	//Main Ask Now
	Route::get('ask/question/new', 'AskQuestionController@index')->name('askquestion.index');
	Route::post('ask/question/new', 'AskQuestionController@store')->name('askquestion.store');


	//My Questions
	Route::get('my-questions', 'WelcomeController@myquestions')->name('my-questions');

	//My Profile
	Route::view('my-profile', 'frontend.myprofile')->name('myprofile.show');
});

//Common
Route::middleware(['auth:sanctum'])->group(function(){
	//Get Topics of Subject
	Route::get('ask/question/get-topics/{subject}', 'AskQuestionController@gettopics')->name('getTopics');

	//Answer Post
	Route::post('answer/submit', 'AskQuestionController@answerstore')->name('storeAnswer');
});

//Admin Panel
Route::middleware(['auth:sanctum','admin'])->prefix('admin')->group(function(){
	Route::get('/','AdminDashboardController@index');
	Route::get('dashboard','AdminDashboardController@index')->name('dashboard');

	Route::view('subjects', 'admin.Subjects.index')->name('subjects');
	Route::view('topics', 'admin.Topics.index')->name('topics');

	Route::resource('questions', 'admin\QuestionController');
	Route::get('questions/get/data', 'admin\QuestionController@getData')->name('questions.getData');
	
});