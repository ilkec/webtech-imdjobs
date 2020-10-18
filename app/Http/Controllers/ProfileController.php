<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function updateProfile(){
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/update', $data);
    }

    public function handleUpdateProfile(Request $request){
        $id = session('User');
        $validation = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'description' => 'required',
            'phonenumber' => 'required',
            'city' => 'required',
            'linkedin'=> 'nullable',
            'dribbble'=> 'nullable',
            'behance'=> 'nullable',
            'website'=> 'nullable',
            
        ]);
        $request->flash();
        DB::table('users')
            ->where('id', $id )
            ->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'description' => $request->description,
                'phone_number' => $request->phonenumber,
                'city' => $request->city,
                'linkedin'=> $request->linkedin,
                'dribbble'=> $request->dribbble,
                'behance'=> $request->behance,
                'website'=> $request->website,
                ]);
        $request->session()->flash('updateMessage', 'Your profile was successfully updated');        
        return redirect('/user/profile');
        
    }
    
    public function showProfile(){
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/profile', $data);
        
    
    }

    
}
