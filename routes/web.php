<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TeacherController;

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('panel.dashboard');

    Route::resource('teacher', TeacherController::class)->names('panel.teacher');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
