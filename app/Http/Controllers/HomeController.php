<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::all();
        $categories = Category::all();
        return view('index',['posts'=> $posts,'categories'=> $categories]);
    }
}