<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Questionlikedislike;
use Auth;

class QuestionVoting extends Component
{
    //Question ID
    public $questionId;

    //Like Dislike Counts
    public $upvotes;
    public $downvotes;

    //Is voted
    public $isVoted;
    public $isLiked;
    public $isDisliked;

    public function mount()
    {
        if (Auth::user()){
            $voteExistance = Questionlikedislike::where(['user_id'=>Auth::user()->id , 'question_id'=>$this->questionId])->get();
            if ($voteExistance->count() > 0) {
                $this->isVoted = 1;
                
                if($voteExistance->first()->upordown == 1){
                    $this->isLiked = 1;
                } else $this->isDisliked = 1;
            } else $this->isVoted = 0;
        }
    }

    public function render()
    {
        return view('livewire.question-voting');
    }

    public function like()
    {
        if ($this->isVoted == 0){
            Question::find($this->questionId)->increment('upvotes', 1);
            Questionlikedislike::create(['user_id'=>Auth::user()->id , 'question_id'=>$this->questionId , 'upordown'=>1]);
            $this->upvotes++;
            $this->isVoted = 1;
            $this->isLiked = 1;
        }        
    }

    public function dislike()
    {
        if ($this->isVoted == 0){
            Question::find($this->questionId)->increment('downvotes', 1);
            Questionlikedislike::create(['user_id'=>Auth::user()->id , 'question_id'=>$this->questionId , 'upordown'=>0]);
            $this->downvotes++;
            $this->isVoted = 1;
            $this->isDisliked = 1;
        }
    }
}