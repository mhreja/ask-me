<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;
use Storage;
use Session;
use Auth;

class AskQuestionController extends Controller
{
    public function index(){
        $subjects = Subject::orderBy('subject')->get();
        return view('frontend.askquestion', ['allsubjects'=>$subjects]);
    }

    public function gettopics(Subject $subject){
        return $subject->topics;
    }

    public function store(Request $request){
        $request->validate([
            'title'=>['required', 'string', 'max:255'],
            'subject_id'=>['required', 'numeric'],
            'topic_id'=>['required', 'numeric'],
            'details'=>['required', 'string',],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:1500'],
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('questions', $request->file('image'));
            $request->merge(['photo'=>$path]);
        }

        $request->merge(['user_id'=>Auth::user()->id]);

        Question::create($request->all());
        
        return redirect()->back()->with('newquestionadded', 'Your question has been submitted succesfully.');
    }

    public function miniask(Request $request){
        if($request->has('question')){
            Session::flash('askquestion', $request->question);
        }
        return redirect()->route('askquestion.index')->with('pleasefillmore', 'Please fill some more details.');
    }

    public function answerstore(Request $request){
        $request->validate([
            'answer'=>['required', 'string',],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:1500'],
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('answers', $request->file('image'));
            $request->merge(['photo'=>$path]);
        }

        //If it's admin approve the answer
        if(Auth::user()->is_admin == 1){
            $request->merge(['is_approved'=>1]);
            $request->merge(['is_correct_marked'=>1]);

            //Mark the question as admin answered
            Question::find($request->input('question_id'))->update(['has_admin_answered'=>1]);
        }

        $request->merge(['user_id'=>Auth::user()->id]);

        Answer::create($request->all());
        
        return redirect()->back()->with('newquestionadded', 'Your answer has been submitted succesfully. ');
    }
}