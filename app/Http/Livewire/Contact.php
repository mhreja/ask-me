<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Mail;
use App\Mail\ContactUs;

class Contact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;

    public function render()
    {         
        return view('livewire.contact');
    }
    

    public function submit(){
        $this->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'email', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'message'=>['required', 'string', 'min:10'],
        ]);
        
        $request = [
            'name'=>$this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ];

        Mail::send(new ContactUs($request));

        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
        
        session()->flash('success', 'Submitted, thanks for contacting us.');
    }
}