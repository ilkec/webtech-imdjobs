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
        //return view('/user/profileUpdate');
        return redirect('/user/profileUpdate/' . $id);
        
    }

    
}
