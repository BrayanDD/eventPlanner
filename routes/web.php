<?php

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//events
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');

Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->name('events.create');
Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');


//invitations
Route::post('/invitations', [Invitation::class, 'store'])->name('invitations.store');
