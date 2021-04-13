<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject;

class AddSubject extends Component
{
    public $subject;

    public function render()
    {
        return view('livewire.add-subject');
    }

    public function submit(){
        $this->validate([
            'subject'=>['required', 'string', 'max:255'],
        ],
        [
            'subject.required'=>'Please insert a Subject Name.',
        ]);

        $data = [
            'subject'=>$this->subject,
        ];

        Subject::create($data);
        
        $this->subject = '';
        $this->emit('subjectAdded');
                
        session()->flash('success', 'New Subject Added.');
    }
}