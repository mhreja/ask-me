<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class ThenotesController extends Controller
{
    public function tcornerList(){
        $notes = Note::where('note_type', 1)->latest()->paginate(15);
        return view('frontend.tcornerList', ['notes'=>$notes]);
    }

    public function tcornerInner(Note $note){
        return view('frontend.tcornerInner', ['note'=>$note]); 
    }

    public function notesList(){
        $notes = Note::where('note_type', 2)->latest()->paginate(15);
        return view('frontend.notesList', ['notes'=>$notes]);
    }

    public function notesInner(Note $note){
        return view('frontend.noteInner', ['note'=>$note]); 
    }
}