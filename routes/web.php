<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
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
Route::get('/p',[PostController::class,'create'])->name('post-index')->middleware('auth');
Route::get('/p/{post}',[PostController::class,'sho'])->name('single');
Route::get('/pe/{post}',[PostController::class,'edit'])->name('edit-post');
Route::patch('/pe/{post}',[PostController::class,'update'])->name('post-update');
Route::get('/pd/{post}',function ($post ) {
    $post = Post::where('id', $post)->first();
    if (Auth::check() && Auth::user()->id == $post->user_id) {
    $post->delete();
    return redirect()->back()->with('success','deleted your post');
    }else{
        return redirect()->back()->with('error','this post not yours, you cant delete this post');
    }})->name('del-pos');
    Route::get('/cd/{cat}',function ($cat ) {
        if (Post::where('category_id', $cat)->first()) {
        return redirect()->back()->with('error','this cat exists on post');
        }else{
        $cat = Category::where('id', $cat)->delete();
        return redirect()->back()->with('success','deleted your category');
        }
        })->name('del-cat');
Route::get('/ce/{id}',[CategoryController::class,'edit'])->name('edit-cat');
Route::patch('/ce/{id}',[CategoryController::class,'update'])->name('category-update');

Route::get('/dashboard/showp',[PostController::class,'show'])->name('show-p')->middleware('auth');
Route::post('/p',[PostController::class,'store'])->name('post-store')->middleware('auth');
Route::get('/c',[CategoryController::class,'create'])->name('cat-index')->middleware('auth');
Route::get('/dashboard/showc',[CategoryController::class,'show'])->name('show-c')->middleware('auth');
Route::post('/c',[CategoryController::class,'store'])->name('cat-store')->middleware('auth');
Route::get('/logini',[LoginController::class,'create'])->name('Login')->middleware('guest');
Route::post('/logini',[LoginController::class,'store'])->name('Login-store')->middleware('guest');
Route::get('/logout',function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth');
Route::get('/Register',[RegisterController::class,'create'])->name('Register')->middleware('guest');
Route::post('/Register',[RegisterController::class,'store'])->name('Register-store')->middleware('guest');

require __DIR__.'/auth.php';
