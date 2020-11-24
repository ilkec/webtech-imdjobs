<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Goutte\Client;


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
        $data['applications'] = DB::table('applications')->join('internships', 'internships.id', '=', 'applications.internship_id')->join('companies', 'companies.id', '=', 'applications.company_id')->where('user_id', $id)->get();
        return view('/user/applications', $data);
    }

    public function handleUpdateProfile(Request $request)
    {

        $id = session('User');
        $validation = $request->validate([
            'image' => 'nullable',
            'firstname' => 'required',
            'lastname' => 'required',
            'description' => 'required',
            'phonenumber' => 'required',
            'education'=>'nullable',
            'school'=>'nullable',
            'city' => 'required',
            'cv' => 'nullable',
            'linkedin'=> 'nullable',
            'dribbble'=> 'nullable',
            'behance'=> 'nullable',
            'github' => 'nullable',
            'website'=> 'nullable',
            
        ]);
        $imagePath = "";
        $cvPath ="";

        if ($request->image) {
            $imagePath = $request->image->store('images', 'public');
        }else{
            $data['image'] = \App\Models\User::where('id', $id)->first();
            $imagePath = $data['image']->picture;  
        }

        if ($request->cv) {
            $cvPath = $request->cv->store('files', 'public');
        }else{
            $data['cv'] = \App\Models\User::where('id', $id)->first();
            $cvPath = $data['cv']->cv; 
            //dd($cvPath); 
        }


        //scrape dribbble profile and store data in db
       $url = $request->input('dribbble'); //get dribbble link from inputfield
       $data['users'] =  \App\Models\User::where('id', $id)->with('portfolio')->first();
        if(!empty($url)){
            $client = new Client;
            $crawler = $client->request('GET', $url);
            $scrape['items'] = $crawler->filter('.js-shot-thumbnail-base')->each(function ($node) {
                $images =  $node->filter('figure > img')->attr('src');
                $text = $node->filter('.shot-title')->text();
                $link = "https://dribbble.com" . $node->filter('.shot-thumbnail-link')->attr('href');
                return ["link"=>$link, "image"=> $images, "text"=>$text];
             });
             $portfolioItems = array_slice($scrape['items'], 0, 4);
        
            //dd($portfolioItems);
            
            foreach($portfolioItems as $portfolioitem){
                $portfolio = new \App\Models\Portfolio();
                $portfolio->image = $portfolioitem['image'];
                $portfolio->link = $portfolioitem['link'];
                $portfolio->text = $portfolioitem['text'];
                $portfolio->user_id = $id;
                $portfolio->save();
            
            }
        

        }else{
            $scrape['items'] = "no items to update";
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
                'education' => $request->education,
                'school' => $request->school,
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
        $data['users'] =  \App\Models\User::where('id', $id)->with('portfolio')->first();
       // $data['users'] = $data['users'][0];


        /*$user = \App\Models\User::where('id', 52)->first();
        dd($user->portfolio()->get());*/
        

        //dd($data['users']->portfolio);
        return view('/user/profile', $data);
        
    
    }

    

    public function userType()
    {
        $data['user'] = Auth::user();
        return view('home', $data);

        

    }

    
    
}
