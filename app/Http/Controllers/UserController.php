<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /* --- REGISTER --- */
    public function register()
    {
        return view('/register');
    }

    public function handleRegister(Request $request)
    {
        // check if making an employer or student account
        if ($request->input('accountType') == 1) {
            $validation = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|max:255|regex:/(.*)@student.thomasmore\.be/i|unique:users',
                'password' => 'required',
            ]);
        } else {
            $validation = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required',
            ]);
        }
        
        //save user account
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

    /* --- LOGIN --- */
    public function login()
    {
        return view('/login');
    }

    public function handleLogin(Request $request)
    {
        $info = $request->only('email', 'password');
        
        $request->flash();
        //check if login credentials are correct
        if (Auth::attempt($info)) {
            $request->flash();
            $id = Auth::id();
            $request->session()->put('User', $id);
            $data['user'] = \App\Models\User::where('id', $id)->get();
            
            //check if user profile is complete, redirect to update profile if not
            if ($data['user'][0]->description == null) {
                return redirect('/user/update');
            } else {
                return redirect('/');
            }
        } else {
            $request->session()->flash('Login', 'Oops something went wrong, try again!');
            return view('/login');
        }
    }
 
    /* --- LOGOUT --- */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/login');
    }
}
