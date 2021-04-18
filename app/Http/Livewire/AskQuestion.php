<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Topic;
// use App\Models\Question;
use Livewire\WithFileUploads;

class AskQuestion extends Component
{
    use WithFileUploads;

    public $allsubjects;
    public $filteredtopics;

    public $title;
    public $subject;
    public $topic;
    public $details;
    public $image;

    public function mount()
    {
        $this->allsubjects = Subject::orderBy('subject')->get();
        $this->filteredtopics = collect();
    }

    public function render()
    {
        return view('livewire.ask-question');
    }

    public function submit(){
        // dd($this->details);
        $this->validate([
            'title'=>['required', 'string', 'max:255'],
            'subject'=>['required'],
            'topic'=>['required'],
            'details'=>['required', 'string',],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:500'],
        ]);
        
        //code........

        $this->title = '';
        $this->subject = '';
        $this->topic = '';
        $this->details = '';
        $this->image = '';
        
        session()->flash('success', 'Added New Question.');
    }
    
    public function updatedSubject($subject)
    {
        $this->filteredtopics = Subject::find($subject)->topics;
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:5']
        ]);
    }
}