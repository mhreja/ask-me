<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AskQuestionController extends Controller
{
    public function index(){
        return view('frontend.askquestion');
    }

    public function store(Request $request){
        return redirect()->back()->with('newquestionadded', 'Your question has been submitted succesfully.');
    }
}