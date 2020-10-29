<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Goutte\Client;


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
        //$url = "https://api.behance.net/v2/users/matiascorea";
        //$respo = Http::get($url);


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
            ->where('id', $id )
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
        //return redirect('/user/profile/52');
        
    }
    
    public function showProfile($id){
        
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        $url = $data['users']->dribbble;
        
        if(!empty($url)){
            $client = new Client;
            $crawler = $client->request('GET', $url);
            $scrape['items'] = $crawler->filter('.js-shot-thumbnail-base')->each(function ($node) {
                $images =  $node->filter('figure > img')->attr('src');
                $text = $node->filter('.shot-title')->text();
                $link = "https://dribbble.com" . $node->filter('.shot-thumbnail-link')->attr('href');
                return ["link"=>$link, "image"=> $images, "text"=>$text];
             });
        }else{
            $scrape['items'] = "no items to update";
        }
        





        //dd($scrape);
        return view('/user/profile', $data, $scrape);
        
    
    }

    public function showPortfolio(){
        $client = new Client;
        
        /*$url = 'http://ilkecauwenbergh.be';
        $crawler = $client->request('GET', $url);
        $test['testing'] = $crawler->filter('img')->each(function ($node) {
            return 'http://ilkecauwenbergh.be'. "/" . $node->attr('src');

         });

         $data['href'] = $crawler->filter('a')->each(function ($node) {
            return 'http://ilkecauwenbergh.be'. "/" . $node->attr('href');
        
         });*/

         $url = 'https://dribbble.com/Piqodesign';
        $crawler = $client->request('GET', $url);
        $test['testing'] = $crawler->filter('.js-shot-thumbnail-base')->each(function ($node) {
            $images =  $node->filter('figure > img')->attr('src');
            $text = $node->filter('.shot-title')->text();
            $link = "https://dribbble.com" . $node->filter('.shot-thumbnail-link')->attr('href');
            return ["link"=>$link, "image"=> $images, "text"=>$text];
         });

         /*$data['href'] = $crawler->filter('a')->each(function ($node) {
            return 'http://ilkecauwenbergh.be'. "/" . $node->attr('href');
        
         });*/
         
         
         
        //dd($test['testing']);
       
        return view('/student/details', $test);
    }

    
}
