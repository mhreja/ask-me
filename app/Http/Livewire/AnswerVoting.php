<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Answer;
use App\Models\Answerlikedislike;
use Auth;

class AnswerVoting extends Component
{

    //Answer ID
    public $answerId;

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
            $voteExistance = Answerlikedislike::where(['user_id'=>Auth::user()->id , 'answer_id'=>$this->answerId])->get();
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
        return view('livewire.answer-voting');
    }

    public function like()
    {
        $userId = Answer::find($this->answerId)->user_id;

        if ($this->isVoted == 0 && $userId != Auth::user()->id){
            Answer::find($this->answerId)->increment('upvotes', 1);
            Answerlikedislike::create(['user_id'=>Auth::user()->id , 'answer_id'=>$this->answerId , 'upordown'=>1]);
            
            User::find($userId)->increment('points', UPVOTE_POINT);
            $this->upvotes++;
            if($this->upvotes == 5){
                User::find($userId)->increment('points', UPVOTE5_POINT_REWARD);
            }
            $this->isVoted = 1;
            $this->isLiked = 1;
        }        
    }

    public function dislike()
    {
        $userId = Answer::find($this->answerId)->user_id;
        
        if ($this->isVoted == 0 && $userId != Auth::user()->id){
            Answer::find($this->answerId)->increment('downvotes', 1);
            Answerlikedislike::create(['user_id'=>Auth::user()->id , 'answer_id'=>$this->answerId , 'upordown'=>0]);
            
            User::find($userId)->decrement('points', DOWNVOTE_POINT);
            $this->downvotes++;
            if($this->downvotes == 5){
                User::find($userId)->decrement('points', DOWNVOTE5_POINT_CUT);
            }
            $this->isVoted = 1;
            $this->isDisliked = 1;
        }
    }
}