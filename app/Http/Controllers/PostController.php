<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category;


use function Pest\Laravel\post;

class PostController extends Controller
{
    public function create(){
        $category = Category::all();
        return view('posts.create',["category"=>$category]);
    }
    public function store(PostStoreRequest $request)
    {
     
        $post = Post::create($request->validated());

     
        return back()->with('success', 'پست با موفقیت ایجاد شد.');
    }
}

