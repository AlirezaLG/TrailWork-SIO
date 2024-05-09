<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tmaController;
use App\Http\Controllers\projectController;
use Illuminate\Support\Facades\Auth;



Auth::routes();


Route::middleware('auth')->group(function () {

    Route::get('/', [tmaController::class, 'index'])->name('tma.index');

    Route::resource('tma', tmaController::class);

    Route::get('/export', [tmaController::class, 'export'])->name('tma.export');

    Route::resource('projects', projectController::class);
});
