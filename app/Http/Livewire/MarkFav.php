<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Question;
use App\Models\Favoritequestion;
use Auth;

class MarkFav extends Component
{
    //Question ID
    public $questionId;

    //Is Marked Fav
    public $isMarkedFav;

    public function mount(){
        if (Auth::user()){
            $favExistance = Favoritequestion::where(['user_id'=>Auth::user()->id , 'question_id'=>$this->questionId])->get();
            if ($favExistance->count() > 0) {
                $this->isMarkedFav = 1;
            } else {
                $this->isVoted = 0;
            }
        }
    }
    
    public function render()
    {
        return view('livewire.mark-fav');
    }

    public function markFav()
    {
        if ($this->isMarkedFav == 0){
            Favoritequestion::create(['user_id'=>Auth::user()->id , 'question_id'=>$this->questionId]);
            $this->isMarkedFav = 1;
        }    
    }
}