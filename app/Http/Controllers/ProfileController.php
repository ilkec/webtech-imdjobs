<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile($id){
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/profileUpdate', $data);
    }

    public function updateProfile(Request $request, $id){

        $validation = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'description' => 'required',
            'phonenumber' => 'required',
            'city' => 'required'
            
        ]);
        
        DB::table('users')
            ->where('id', $id )
            ->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'description' => $request->description,
                'phone_number' => $request->phonenumber,
                'city' => $request->city,
                ]);
                
        //return view('/user/profileUpdate');
        return redirect('/user/profileUpdate/' . $id);
        
    }

    
}
