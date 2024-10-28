<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Home', [NotesController::class, 'index' ])->name('notes.index');
Route::get('/create', [NotesController::class, 'create' ])->name('notes.create');
Route::post('/Home', [NotesController::class, 'save' ])->name('notes.save');
Route::get('/Home{note}/view-edit', [NotesController::class, 'viewEdit' ])->name('notes.view-edit');
Route::put('/Home{note}/view-update', [NotesController::class, 'viewUpdate' ])->name('notes.view-update');
Route::delete('/Home{note}/delete', [NotesController::class, 'delete' ])->name('notes.delete');
Route::get('/Home/{note}', [NotesController::class, 'show'])->name('notes.view');
Route::get('/log', [NotesController::class, 'log'])->name('notes.log');
Route::get('/Home{note}/index-edit', [NotesController::class, 'indexEdit' ])->name('notes.index-edit');
Route::put('/Home{note}/index-update', [NotesController::class, 'indexUpdate' ])->name('notes.index-update');

