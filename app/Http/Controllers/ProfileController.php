<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){
        return view('/register');
    }

    public function updateProfile(Request $request){
        $user = new \App\Models\User();
        
        
    }

    
}
