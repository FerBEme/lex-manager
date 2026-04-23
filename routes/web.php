<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/lawyer/home', function () {
    return view('lawyer.home');
});
Route::get('/secretary/home', function () {
    return view('secretary.home');
});