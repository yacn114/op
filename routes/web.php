<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return view('welcome');
});

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
require __DIR__.'/auth.php';
