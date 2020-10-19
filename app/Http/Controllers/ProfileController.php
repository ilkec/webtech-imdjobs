<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function updateProfile(){
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/update', $data);
    }

    public function handleUpdateProfile(Request $request){

       // $request->image->store('images', 'public');
        //$request->photo->path();
        //dd($request->image->path());
        
        $id = session('User');
        $validation = $request->validate([
            'image' => 'required',
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

       $imagePath = $request->image->store('images', 'public');
        $request->flash();
        DB::table('users')
            ->where('id', $id )
            ->update([
                'picture' => $imagePath,
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
        return redirect('/user/profile/' . $id);
        //return redirect('/user/profile/52');
        
    }
    
    public function showProfile($id){
        
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/profile', $data);
        
    
    }

    
}
