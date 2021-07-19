<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class TodayscornerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('note_type', 1)->latest()->get();
        return view('admin.todays-corner.index', ['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.todays-corner.create');
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

        $request->merge(['note_type'=>1]);

        Note::create($request->all());
        
        return redirect()->back()->with('success', 'New Todays Corner Added Succesfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $todays_corner)
    {
        return view('admin.todays-corner.show', ['note'=>$todays_corner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $todays_corner)
    {
        return view('admin.todays-corner.edit', ['note'=>$todays_corner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $todays_corner)
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

        $todays_corner->update($request->all());
        
        return redirect()->back()->with('info', 'Todays Corner Updated Succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $todays_corner)
    {
        $todays_corner->delete();
        return redirect()->back()->with('error', 'Todays Corner Deleted Succesfully.');
    }
}