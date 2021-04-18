<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Topic;

class AddTopic extends Component
{
    public $subject;
    public $topic;

    public function render()
    {
        $subjects = Subject::orderBy('subject', 'asc')->get();
        return view('livewire.add-topic', ['subjects'=>$subjects]);
    }

    public function submit(){
        $this->validate([
            'subject'=>['required', 'numeric', 'max:255'],
            'topic'=>['required', 'string', 'max:255'],
        ],
        [
            'subject.required'=>'Please select a Subject.',
            'topic.required'=>'Please insert a Topic Name.',
        ]);

        $data = [
            'subject_id'=>$this->subject,
            'topic'=>$this->topic,
        ];

        Topic::create($data);
        
        $this->subject = '';
        $this->topic = '';
        $this->emit('topicAdded');
                
        session()->flash('success', 'New Topic Added.');
    }
}