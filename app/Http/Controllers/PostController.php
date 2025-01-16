<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostUpdateRequest;


class PostController extends Controller
{
    public function create(){
        $category = Category::all();
        return view('posts.create',["category"=>$category]);
    }
    public function store(PostStoreRequest $request)
    {
        $data = $request->validated(); // داده‌های تاییدشده از PostStoreRequest
        $data['user_id'] = Auth::id();
        $post = Post::create($data);

     
        return back()->with('success', 'پست با موفقیت ایجاد شد.');
    }
    public function show(Post $post){
        return view('posts.post',['post'=>$post::all()]);
    }
    public function edit(Post $post){
        if(Auth::user()->id == $post->user_id){
            return view('posts.edit',['post'=>$post]);
        }else{
        return back()->with('error','this post not yours');
    }
    }
    public function update(PostUpdateRequest $request, Post $post){
        
        if(Auth::user()->id == $post->user_id){
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $post->update($data);
        return redirect()->route('show-p')->with('success','updated');
        }else{
            return redirect()->route('show-p')->with('error','this post not yours');
        }
    }
}

