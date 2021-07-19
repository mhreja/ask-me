<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dailyquestion;

class AddDailyquestion extends Component
{
    public $mcq;

    public function render()
    {
        return view('livewire.add-dailyquestion');
    }

    public function submit(){
        $this->validate([
            'mcq'=>['required', 'string'],
        ]);

        $data = [
            'mcq'=>$this->mcq,
            'is_active'=>1,
        ];

        Dailyquestion::create($data);
        
        $this->mcq = '';
        $this->emit('mcqAdded');
                
        session()->flash('success', 'New MCQ Added.');
    }
}