<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(){
        return view('/register');
    }

    public function handleRegister(Request $request){
        $user = new \App\Models\User();
        $user->first_name = $request->input('firstname');
        $user->last_name = $request->input('lastname');
        $user->email = $request->input('email');
        $user->account_type = $request->input('accountType');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('/register');
        
    }

    public function login(){
        return view('/login');
    }

    public function handleLogin(){
        return view('/login');
    }
}
