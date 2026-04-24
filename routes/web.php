<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('auth.login');
})->name('login');



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['role:admin'])
    ->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', fn() => view('admin.users.index'))->name('index');
        Route::get('/create', fn() => view('admin.users.create'))->name('create');
        Route::get('/{user}/edit', fn($user) => view('admin.users.update', compact('user')))->name('edit');
    });
});



Route::prefix('lawyer')
    ->name('lawyer.')
    ->group(function () {
    Route::get('/home', function () {
        return view('lawyer.home');
    })->name('home');
});
Route::prefix('secretary')->name('secretary.')->group(function () {
    Route::get('/home', function () {
        return view('secretary.home');
    })->name('home');
});