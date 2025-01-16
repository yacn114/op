<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function create(Request $request){
        return view("auths.login");
    }
    public function store(LoginRequest $request){
        
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
        }
}
