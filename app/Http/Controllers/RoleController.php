<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
class RoleController extends Controller
{
    public function show(){
        $role = Role::all();
        
        return view("role.show",["role"=> $role]);
    }
    public function store(RoleRequest $request){
        $role = Role::create(['name'=>$request->validated("title")]);
        $role->permissions()->sync($request->validated("Permission"));
        return redirect()->route("show-r")->with("success","created!");
    }
    public function edit(Role $role){
    return view("role.edit",["role"=> $role]);
    }
    public function update(RoleRequest $request){
        $role = Role::where("name",$request->validated("title"))->first();
        $role->update(["name"=>$request->validated("title")]);
        $role->permissions()->sync($request->validated("Permission"));
        return redirect()->route("show-r")->with("success","updated");
    }

}
