<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        return view("cat.cat");
    }
    public function store(CategoryCreateRequest $request){
        $post = Category::create($request->validated());

     
        return back()->with('success', 'پست با موفقیت ایجاد شد.');
        
}
}