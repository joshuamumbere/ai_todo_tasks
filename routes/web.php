<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', function () {
    // Redirect authenticated users to the tasks page
    return Auth::check() ? redirect()->route('tasks') : view('welcome');
})->name('tasks');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Register TaskManager Interface Here
    Volt::route('tasks', 'task-manager')->name('tasks');
});

require __DIR__.'/auth.php';
