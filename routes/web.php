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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use GuzzleHttp\Middleware;

// Start Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// End Dashboard

// HomeController
Route::controller(HomeController::class)->group(function(){
Route::get('/','index')->name('home');

});
// End HomeController

// Start PostController
Route::controller(PostController::class)->group(function () {
    Route::get('/p','create')->name('post-index')->middleware('auth');
    Route::get('/p/{post}','sho')->name('single');
    Route::get('/pe/{post}','edit')->name('edit-post');
    Route::patch('/pe/{post}','update')->name('post-update');
    Route::get('/pd/{post}',function ($post ) {
        $post = Post::where('id', $post)->first();
        if (Auth::check() && Auth::user()->id == $post->user_id) {
        $post->delete();
        return redirect()->back()->with('success','deleted your post');
        }else{
            return redirect()->back()->with('error','this post not yours, you cant delete this post');
        }})->name('del-pos');
    Route::post('/p','store')->name('post-store')->middleware('auth');
    Route::get('/dashboard/showp','show')->name('show-p')->middleware('auth');
    });
// End PostController

// Start CategoryController
Route::controller(CategoryController::class)->group(function () {
Route::get('/cd/{cat}',function ($cat) {
    if (Post::where('category_id', $cat)->first()) {
    return redirect()->back()->with('error','this cat exists on post');
    }else{
    $cat = Category::where('id', $cat)->delete();
    return redirect()->back()->with('success','deleted your category');
    }})->name('del-cat');
Route::get('/ce/{id}','edit')->name('edit-cat');
Route::patch('/ce/{id}','update')->name('category-update');
Route::get('/c','create')->name('cat-index')->middleware('auth');
Route::get('/dashboard/showc','show')->name('show-c')->middleware('auth');
Route::post('/c','store')->name('cat-store')->middleware('auth');
});
// End CategoryController

// start LoginController
Route::get('/logini',[LoginController::class,'create'])->name('Login')->middleware('guest');
Route::post('/logini',[LoginController::class,'store'])->name('Login-store')->middleware('guest');
Route::get('/logout',function () {
    Auth::logout();
    return redirect('/');
})->middleware('auth');
// End LoginController

// Start RegisterController
Route::get('/Register',[RegisterController::class,'create'])->name('Register')->middleware('guest');
Route::post('/Register',[RegisterController::class,'store'])->name('Register-store')->middleware('guest');
// End RegisterController

// Start RoleController
Route::controller( RoleController::class)->group(function(){
        Route::get('/dashboard/roles','show')->name('show-r');
        Route::post('/dashboard/roles','store')->name('role-store');
        Route::delete('/delete-role/{role}',function(Role $role){
            if(Auth::check() && Auth::user()->name == "yacn"){
                $role->permissions()->detach();
                $role->delete();

            return redirect()->route('show-r')->with('success','deleted!');

            }else{
                return redirect()->route('show-r')->with('error','403 you not access this action, oonly my owner Yacn1414');
            }
        })->name('delete-role');
        Route::get('/role-edit/{role}','edit')->name('role-edit');
        Route::patch('/role-edit','update')->name('role-update');
});
// End RoleController
require __DIR__.'/auth.php';
