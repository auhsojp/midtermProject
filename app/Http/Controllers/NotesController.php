<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    
    public function index(){
        $notes = Note::latest()->get(); 
        return view('index', ['notes' => $notes]);
    }
    public function show(Note $note)
    {
        return view('view', compact('note'));
    }
    public function create(){
        return view('create');
    }
    public function save(Request $request){
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:100',
            'content' => 'required|string|min:1|max:10000'
        ]);

        $newNoteS = Note::create($validatedData);

        return redirect(route('notes.index'))->with('success', 'Notes Successfully Created');

    }
    public function indexEdit(Note $note){
        return view('index-edit', ['note' => $note]);
    }

    public function indexUpdate(Note $note, Request $request){
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:100',
            'content' => 'required|string|min:1|max:10000'
        ]);

        $note->update($validatedData);
        return redirect(route('notes.index', ['note' => $note]))->with('success', 'Notes Successfully Edited');
    }

    public function viewEdit(Note $note){
        return view('view-edit', ['note' => $note]);
    }

    public function viewUpdate(Note $note, Request $request){
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:100',
            'content' => 'required|string|min:1|max:10000'
        ]);

        $note->update($validatedData);
        return redirect(route('notes.view', ['note' => $note]))->with('success', 'Notes Successfully Edited');
    }

    public function delete(Note $note){
        $note->delete();
        return redirect(route('notes.index'))->with('success', 'Notes  Successfully deleted');
    }

    public function log(Request $request){
        return redirect()->route('notes.index'); 
}

}
