<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tmaController;
use App\Http\Controllers\projectController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/tma', [tmaController::class, 'index'])->name('tma.index');
Route::get('/tma/create', [tmaController::class, 'create'])->name('tma.create');
Route::get('/tma/{id}', [tmaController::class, 'show'])->name('tma.show');
Route::get('/tma/{id}/edit', [tmaController::class, 'edit'])->name('tma.edit');
Route::post('/tma', [tmaController::class, 'store'])->name('tma.store');
Route::put('/tma/{id}', [tmaController::class, 'update'])->name('tma.update');
Route::delete('/tma/{id}', [tmaController::class, 'destroy'])->name('tma.destroy');

Route::get('/export', [tmaController::class, 'export'])->name('tma.export');

Route::get('/projects', [projectController::class, 'index'])->name('projects.index');
// tma routes
// Route::middleware('auth')->group(function () {
//     Route::resource('tma', tmaController::class);
// });
