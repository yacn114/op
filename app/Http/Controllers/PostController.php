<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{

    public function create(){
        $category = Category::all();
        return view('posts.create',["category"=>$category]);
    }
    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $post = Post::create($data);


        return back()->with('success', 'پست با موفقیت ایجاد شد.');
    }
    public function show(Post $post,User $user){
        if($user->can('view',$post)){
        return view('posts.post',['post'=>$post::all()]);
        }else{
            abort(403);
        }
    }
    public function edit(Post $post){

        // if(Gate::allows('update-post')){
        if(Auth::user()->id == $post->user_id){
            return view('posts.edit',['post'=>$post]);
        }else{
        return back()->with('error','this post not yours');
    }
        // }else{
        //     abort(403);
        // }
    }
    public function update(PostUpdateRequest $request, Post $post,User $user){
        if($user->can('update',$post)){
        if(Auth::user()->id == $post->user_id){
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $post->update($data);
        return redirect()->route('show-p')->with('success','updated');
        }else{
            return redirect()->route('show-p')->with('error','this post not yours');
        }
    }else{
        abort(403);
    }
    }
    public function sho(User $user,Post $post){
        if ($user->can('view',$post)){
        return view('posts.show',['post'=>$post]);
        }else{
            $username = Auth::check() ? Auth::user()->name : null;
            abort(403,"this post not yours {{". $username . "}}");
        }
    }
}

