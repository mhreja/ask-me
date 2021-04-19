<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Answerlikedislike;
use Auth;

class AnswerVoting extends Component
{
    public function render()
    {
        return view('livewire.answer-voting');
    }
}