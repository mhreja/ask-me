<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Dailyquestion;

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
            $q->where('answers.is_approved', 1);
        }])->orderBy('answers_count', 'DESC')
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

    public function adminfavquestions(){
        $adminfavquestions = Question::where('questions.is_approved', 1)
        ->where('is_favorite', 1)
        ->paginate(6);
        return view('frontend.adminfavquestions', ['adminfavquestions'=>$adminfavquestions]);
    }


    public function myquestions()
    {
        $myQuestions = Auth::user()->questions()->latest()->paginate(6);
        return view('frontend.myquestions', ['myQuestions'=>$myQuestions]);
    }

    public function subjectQuestions(Subject $subject){
        $questions = $subject->questions()->where('is_approved', 1)->latest()->paginate(6);
        return view('frontend.subjectQuestions', ['subject'=>$subject, 'questions'=>$questions]);
    }

    public function topicQuestions(Topic $topic){
        $questions = $topic->questions()->where('is_approved', 1)->latest()->paginate(6);
        return view('frontend.topicQuestions', ['topic'=>$topic, 'questions'=>$questions]);
    }

    public function searchedQuestions(Request $request){
        $questions = Question::where('is_approved', 1)
            ->where('title', 'LIKE', "%{$request->keyword}%")
            ->orWhere('details', 'LIKE', "%{$request->keyword}%")
        ->paginate(6);
        return view('frontend.searchedQuestions', ['questions'=>$questions]);
    }

    public function questionInner(Question $question){
        if($question->is_approved == 0){
            return abort(404);
        }
        
        $relatedQuestions = Question::where('topic_id', $question->topic->id)
            ->where('id', '!=', $question->id)
            ->where('is_approved', 1)
        ->orderBy('upvotes', 'DESC')->take(5)->get();
        return view('frontend.questionInner', ['question'=>$question, 'relatedQuestions'=>$relatedQuestions]);
    }

    public function dailymcqList(){
        $mcqs = Dailyquestion::where('is_active', 1)->latest()->paginate(25);
        return view('frontend.dailyMcqs', ['mcqs'=>$mcqs]);
    }


}