<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Storage;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('note_type', 2)->latest()->get();
        return view('admin.notes.index', ['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required', 'string', 'max:255'],
            'description'=>['required', 'string'],
            'photo'=>['image', 'mimes:jpg,jpeg,png', 'max:1500'],
            'pdf_file'=>['mimes:pdf', 'max:1500']
        ]);

        if ($request->hasFile('photo')) {
            $path = Storage::disk('public')->put('notes', $request->file('photo'));
            $request->merge(['image'=>$path]);
        }

        if ($request->hasFile('pdf_file')) {
            $path = Storage::disk('public')->put('notes', $request->file('pdf_file'));
            $request->merge(['pdf'=>$path]);
        }

        $request->merge(['note_type'=>2]);

        Note::create($request->all());
        
        return redirect()->back()->with('success', 'New Note Added Succesfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('admin.notes.show', ['note'=>$note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('admin.notes.edit', ['note'=>$note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title'=>['required', 'string', 'max:255'],
            'description'=>['required', 'string'],
            'photo'=>['image', 'mimes:jpg,jpeg,png', 'max:1500'],
            'pdf_file'=>['mimes:pdf', 'max:1500']
        ]);

        if ($request->hasFile('photo')) {
            $path = Storage::disk('public')->put('notes', $request->file('photo'));
            $request->merge(['image'=>$path]);
        }

        if ($request->hasFile('pdf_file')) {
            $path = Storage::disk('public')->put('notes', $request->file('pdf_file'));
            $request->merge(['pdf'=>$path]);
        }

        $note->update($request->all());
        
        return redirect()->back()->with('info', 'Note Updated Succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->back()->with('error', 'Note Deleted Succesfully.');
    }
}