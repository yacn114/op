<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/p',[PostController::class,'create'])->name('post-index');
Route::post('/p',[PostController::class,'store'])->name('post-store');
Route::get('/c',[CategoryController::class,'create'])->name('cat-index');
Route::post('/c',[CategoryController::class,'store'])->name('cat-store');
Route::get('/logini',[LoginController::class,'create'])->name('Login')->middleware('guest');
Route::post('/logini',[LoginController::class,'store'])->name('Login-store');
Route::get('/logout',function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/Register',[RegisterController::class,'create'])->name('Register')->middleware('guest');
Route::post('/Register',[RegisterController::class,'store'])->name('Register-store');

require __DIR__.'/auth.php';
