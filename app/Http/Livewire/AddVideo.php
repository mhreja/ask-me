<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Video;

class AddVideo extends Component
{
    public $title;
    public $video_link;

    public function render()
    {
        return view('livewire.add-video');
    }

    public function submit(){
        $this->validate([
            'title'=>['required', 'string', 'max:255'],
            'video_link'=>['required', 'string'],
        ]);

        $data = [
            'title'=>$this->title,
            'video_link'=>$this->video_link,
        ];

        Video::create($data);
        
        $this->title = '';
        $this->video_link = '';
        
        $this->emit('videoAdded');
                
        session()->flash('success', 'New Video Added.');
    }
}