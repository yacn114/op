<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
class RoleController extends Controller
{
    public function show(User $user){
        $a = $user->can('viewAny', Role::class);

        if ($a) {
            $role = Role::all();
            return view("role.show", ["role" => $role]);
        }else{
            abort(403,'get the fuck up');
        }
    }
    public function store(RoleRequest $request){
        $role = Role::create(['name'=>$request->validated("title")]);
        $role->permissions()->sync($request->validated("Permission"));
        return redirect()->route("show-r")->with("success","created!");
    }
    public function edit(Role $role,User $user){
        $a = $user->can('update', Role::class);

        if ($a) {
            return view("role.edit", ["role" => $role]);
        }else{
            abort(403,"برو بچه کیونی");
        }
    }
    public function update(RoleRequest $request){
        // if($request->validated("Permission") == null){
        //     $s = [0];
        // }else{
        //     $s = $request->validated("Permission");
        // }
        // dd($s);
        $role = Role::where("name",$request->validated("title"))->first();
        $role->update(["name"=>$request->validated("title")]);
        $role->permissions()->sync($request->validated("Permission"));
        return redirect()->route("show-r")->with("success","updated");
    }

}
