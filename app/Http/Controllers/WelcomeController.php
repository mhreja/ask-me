<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;

class WelcomeController extends Controller
{
    public function index(){
        $recentQuestions = Question::where('is_approved', 1)->latest()->take(6)->get();

        $mostPopularQuestions = Question::where('is_approved', 1)->orderBy('upvotes', 'desc')->take(6)->get();

        $mostAnsweredQuestions = Question::where('questions.is_approved', 1)
        ->whereHas('answers')->withCount(['answers' => function($q){
            $q->where('answers.is_approved', 0);
        }])->orderBy('answers_count', 'desc')
        ->take(6)->get();

        $notAnsweredQuestions = Question::where('questions.is_approved', 1)
        ->doesntHave('answers')
        ->take(6)->get();
        

    	return view('frontend.index', [
            'recentQuestions'=> $recentQuestions, 
            'mostPopularQuestions'=> $mostPopularQuestions,
            'mostAnsweredQuestions'=> $mostAnsweredQuestions,
            'notAnsweredQuestions'=> $notAnsweredQuestions,
        ]);
    }

    public function recentquestions()
    {
        $recentQuestions = Question::where('is_approved', 1)->latest()->paginate(6);
        return view('frontend.recentquestions', ['recentQuestions'=>$recentQuestions]);
    }

    public function popularquestions()
    {
        $popularQuestions = Question::where('is_approved', 1)->orderBy('upvotes', 'desc')->paginate(6);
        return view('frontend.popularquestions', ['popularQuestions'=>$popularQuestions]);
    }

    public function mostansweredquestions()
    {
        $mostAnsweredQuestions = Question::where('questions.is_approved', 1)
        ->whereHas('answers')->withCount(['answers' => function($q){
            $q->where('answers.is_approved', 0);
        }])->orderBy('answers_count', 'desc')
        ->paginate(6);
        return view('frontend.mostansweredquestions', ['mostAnsweredQuestions'=>$mostAnsweredQuestions]);
    }

    public function notansweredquestions()
    {
        $notAnsweredQuestions = Question::where('questions.is_approved', 1)
        ->doesntHave('answers')
        ->paginate(6);
        return view('frontend.notansweredquestions', ['notAnsweredQuestions'=>$notAnsweredQuestions]);
    }


    public function myquestions()
    {
        $myQuestions = Auth::user()->questions()->latest()->paginate(6);
        return view('frontend.myquestions', ['myQuestions'=>$myQuestions]);
    }


}