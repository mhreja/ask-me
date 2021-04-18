<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeDislike extends Component
{
    public $upvotes;
    public $downvotes;

    public function mount($upvotes, $downvotes)
    {
        $this->upvotes = $upvotes;
        $this->downvotes = $downvotes;
    }
    public function render()
    {
        return view('livewire.like-dislike');
    }
}