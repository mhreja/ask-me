<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;

class WelcomeController extends Controller
{
    public function index(){
        $recentQuestions = Question::where('is_approved', 1)->latest()->take(10)->get();

        $mostPopularQuestions = Question::where('is_approved', 1)->orderBy('upvotes', 'desc')->take(10)->get();

        $mostAnsweredQuestions = Question::where('questions.is_approved', 1)
        ->whereHas('answers')->withCount(['answers' => function($q){
            $q->where('answers.is_approved', 0);
        }])->orderBy('answers_count', 'desc')
        ->take(10)->get();

        $notAnsweredQuestions = Question::where('questions.is_approved', 1)
        ->doesntHave('answers')
        ->take(10)->get();
        

    	return view('frontend.index', [
            'recentQuestions'=> $recentQuestions, 
            'mostPopularQuestions'=> $mostPopularQuestions,
            'mostAnsweredQuestions'=> $mostAnsweredQuestions,
            'notAnsweredQuestions'=> $notAnsweredQuestions,
        ]);
    }
}