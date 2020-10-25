<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateProfile()
    {
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/update', $data);
    }

    public function showApplications()
    {
        $id = session('User');
        $data['applications'] = \DB::table('applications')->join('internships', 'internships.id', '=', 'applications.internship_id')->join('companies', 'companies.id', '=', 'applications.companie_id')->where('user_id', $id)->get();
        return view('/user/applications', $data);
    }

    public function handleUpdateProfile(Request $request)
    {

       // $request->image->store('images', 'public');
        //$request->photo->path();
        //dd($request->image->path());
        
        $id = session('User');
        $validation = $request->validate([
            'image' => 'nullable',
            'firstname' => 'required',
            'lastname' => 'required',
            'description' => 'required',
            'phonenumber' => 'required',
            'city' => 'required',
            'cv' => 'nullable',
            'linkedin'=> 'nullable',
            'dribbble'=> 'nullable',
            'behance'=> 'nullable',
            'github' => 'nullable',
            'website'=> 'nullable',
            
        ]);
        $imagePath ="";
        $cvPath ="";

        if ($request->image) {
            $imagePath = $request->image->store('images', 'public');
        }

        if ($request->cv) {
            $cvPath = $request->cv->store('files', 'public');
        }
       
       
        $request->flash();
        DB::table('users')
            ->where('id', $id)
            ->update([
                'picture' => $imagePath,
                'cv' => $cvPath,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'description' => $request->description,
                'phone_number' => $request->phonenumber,
                'city' => $request->city,
                'linkedin'=> $request->linkedin,
                'dribbble'=> $request->dribbble,
                'behance'=> $request->behance,
                'github'=> $request->github,
                'website'=> $request->website,
                ]);


        $request->session()->flash('updateMessage', 'Your profile was successfully updated');
        return redirect('/user/profile/' . $id);
    }
    
    public function showProfile($id)
    {
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        
        return view('/user/profile', $data);
    }

    public function userType()
    {
        $data['user'] = Auth::user();
        return view('home', $data);
    }
}
