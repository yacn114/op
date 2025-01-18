<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(Request $request){
        return view("auths.Register");
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $roleid = Role::where('name','normal')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleid->id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful');
    
    }
}
