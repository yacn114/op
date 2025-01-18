<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Permission;
use App\Models\Category;
use Illuminate\Routing\Middleware;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    #[Middleware(Permission::class .':read-category')]
    public function create(){
        return view("cat.cat");
    }
    public function store(CategoryCreateRequest $request){
        $post = Category::create($request->validated());

     
        return back()->with('success', 'پست با موفقیت ایجاد شد.');
        
}
public function show(Category $category){
    $category = $category->all();
    return view('cat.show', compact('category'));
}
public function edit($id){
    $categor = Category::where('id', $id)->first();
    // dd($categor);
    return view('cat.edit', ['category'=>$categor]);
}
public function update(CategoryUpdateRequest $request, $id){
    $category = Category::where('id', $id)->first();
    $category = $category->update($request->validated());
    return redirect()->route('show-c')->with('success','edited');    
}
}