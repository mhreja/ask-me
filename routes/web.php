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
Route::get('questions/admin-favorite', 'WelcomeController@adminfavquestions')->name('adminfavquestions');

//Subject Question
Route::get('questions/subject/{subject}', 'WelcomeController@subjectQuestions')->name('subjectQuestions');

//Topic Question
Route::get('questions/topic/{topic}', 'WelcomeController@topicQuestions')->name('topicQuestions');

//Searched Question
Route::get('questions/search', 'WelcomeController@searchedQuestions')->name('searchedQuestions');

//Question Inner Page
Route::get('question/{question}', 'WelcomeController@questionInner')->name('questionInner');

//Todays corner and Notes and Videos
Route::get('today/corners', 'ThenotesController@tcornerList')->name('tcorner');
Route::get('/today/corners/{note}', 'ThenotesController@tcornerInner')->name('tcorner.inner');
Route::view('/videos', 'frontend.videos')->name('videos.list');

Route::get('notes', 'ThenotesController@notesList')->name('thenotes');
Route::get('/notes/{note}', 'ThenotesController@notesInner')->name('thenotes.inner');

//Notice details
Route::get('get/notice/details/{id}', 'admin\AnnouncementController@noticeDetails')->name('notice.details');

// Daily MCQ
Route::get('daily-mcq-questions', 'WelcomeController@dailymcqList')->name('dailymcq.list');




Route::middleware(['auth:sanctum', 'verified', 'user'])->group(function(){
	//Mini Ask Now
	Route::post('ask/question', 'AskQuestionController@miniask')->name('askquestion.miniask');

	//Main Ask Now
	Route::get('ask/question/new', 'AskQuestionController@index')->name('askquestion.index');
	Route::post('ask/question/new', 'AskQuestionController@store')->name('askquestion.store');


	//My Questions
	Route::get('my-questions', 'WelcomeController@myquestions')->name('my-questions');
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

	Route::get('users', 'admin\UserController@index')->name('users.index');
	Route::get('users/get/data', 'admin\UserController@getData')->name('users.getData');

	Route::view('subjects', 'admin.Subjects.index')->name('subjects');
	Route::view('topics', 'admin.Topics.index')->name('topics');

	Route::resource('questions', 'admin\QuestionController');
	Route::get('questions/get/data', 'admin\QuestionController@getData')->name('questions.getData');
	Route::get('questions/mark/approved/{question}', 'admin\QuestionController@markApproved')->name('questions.markApproved');
	Route::get('questions/mark/favorite/{question}', 'admin\QuestionController@markFavorite')->name('questions.markFavorite');
	Route::post('questions/mark/rejected/{question}', 'admin\QuestionController@markRejected')->name('questions.reject');

	Route::resource('answers', 'admin\AnswerController');
	Route::get('answers/get/data', 'admin\AnswerController@getData')->name('answers.getData');
	Route::get('answers/mark/approved/{answer}', 'admin\AnswerController@markApproved')->name('answers.markApproved');
	Route::get('answers/mark/correct/{answer}', 'admin\AnswerController@markCorrect')->name('answers.markCorrect');
	Route::post('answers/mark/rejected/{answer}', 'admin\AnswerController@markRejected')->name('answers.reject');

	Route::resource('notes', 'admin\NotesController');
	Route::resource('todays-corner', 'admin\TodayscornerController');

	//Announcement
	Route::resource('announcements', 'admin\AnnouncementController');

	//Daily Questions
	Route::view('daily-questions', 'admin.dailymcq.index')->name('dailymcq');
	
	//Videos
	Route::view('video/tutorials', 'admin.videos.index')->name('videos');
	
});