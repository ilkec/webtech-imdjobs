<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(){
        return view('/register');
    }

    public function handleRegister(Request $request){

        $validation = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|max:255|unique:users', //regex:/(.*)@student.thomasmore\.be/i|unique:users',
            'password' => 'required',
        ]);

        //$request->session()->flash('status', 'Task was successful!');
        $request->flash();
        $user = new \App\Models\User();
        $user->first_name = $request->input('firstname');
        $user->last_name = $request->input('lastname');
        $user->email = $request->input('email');
        $user->account_type = $request->input('accountType');
        $user->password = Hash::make($request->input('password'));
        $user->save(); 

        $request->session()->flash('message', 'Your registration was successful');
        
        return redirect('/login');
        
    }

    public function login(){
        return view('/login');
    }

    public function handleLogin(Request $request){
        $info = $request->only('email', 'password');
        /*$result = Auth::attempt($info);
        dd($result, $info);*/
        if (Auth::attempt($info)) {
            $request->flash();
            $request->session()->put('User', $request->email);
        //return redirect()->intended('dashboard'); als je naar een bepaalde pagina wil surfen en die is geblokeerd omdat je nog niet ingelogt bent.
        return view('/login');
        }

        
    }
}
