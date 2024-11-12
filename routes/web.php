<?php

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // events
    Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [App\Http\Controllers\EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [App\Http\Controllers\EventController::class, 'update'])->name('events.update');

    // invitations
    Route::get('/invitations', [App\Http\Controllers\InvitationController::class, 'index'])->name('invitations.index');
    Route::post('/invitations', [App\Http\Controllers\InvitationController::class, 'store'])->name('invitations.store');
    Route::put('/invitations/{invitation}', [App\Http\Controllers\InvitationController::class, 'update'])->name('invitations.update');
});