<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index(){
    	return view('contacts');
    }

    public function getdata(){
    	return Contact::all();
    }

    public function store(Request $request){
    	$request->validate([
    		'name'=>['required', 'string', 'max:255'],
    		'father'=>['required', 'string', 'max:255'],
            // 'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email'=>['required', 'string', 'email', 'max:255',],
        ]);
    	Contact::create($request->all());
    	return ['success'=>true, 'message'=>'Data Inserted Successfully.'];
    }

    public function update(Request $request, $id){
    	$request->validate([
    		'name'=>['required', 'string', 'max:255'],
    		'father'=>['required', 'string', 'max:255'],
            // 'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email'=>['required', 'string', 'email', 'max:255',],
        ]);
    	Contact::find($id)->update($request->all());
    	return ['success'=>true, 'message'=>'Data Updated Successfully.'];
    }

    public function delete($id){
    	Contact::find($id)->delete();
    	return ['success'=>true, 'message'=>'Data Deleted Successfully.'];
    }
}
