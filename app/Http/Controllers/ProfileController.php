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
use App\Classes\Email;

class ProfileController extends Controller
{
    /* --- PROFILE --- */
    public function showProfile($id)
    {
        $data['users'] =  \App\Models\User::where('id', $id)->with('portfolio')->first();
        return view('/user/profile', $data);
    }

    /* --- UPDATE PROFILE --- */
    public function updateProfile()
    {
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        //check if user is logged in
        if ($data['users'] != null) {
            return view('/user/update', $data);
        }
        return redirect('/');
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
        if ($request->image) {
            $imagePath = $request->image->store('images', 'public');
        } else {
            $data['image'] = \App\Models\User::where('id', $id)->first();
            $imagePath = $data['image']->picture;
        }

        $cvPath ="";
        if ($request->cv) {
            $cvPath = $request->cv->store('files', 'public');
        } else {
            $data['cv'] = \App\Models\User::where('id', $id)->first();
            $cvPath = $data['cv']->cv;
        }

        //scrape dribbble profile and store data in db
        $url = $request->input('dribbble'); //get dribbble link from inputfield
        $data['users'] =  \App\Models\User::where('id', $id)->with('portfolio')->first();
        if (!empty($url)) {
            $client = new Client;
            $crawler = $client->request('GET', $url);
            $scrape['items'] = $crawler->filter('.js-shot-thumbnail-base')->each(function ($node) {
                $images =  $node->filter('figure > img')->attr('src');
                $text = $node->filter('.shot-title')->text();
                $link = "https://dribbble.com" . $node->filter('.shot-thumbnail-link')->attr('href');
                return ["link"=>$link, "image"=> $images, "text"=>$text];
            });
            $portfolioItems = array_slice($scrape['items'], 0, 4);
            
            //check if dribbble items already exist for user
            if (isset($data['users']->portfolio[0])) {
                $itemsPortfolio[] = \App\Models\Portfolio::where('user_id', $id)
                    ->orderBy('id', 'asc')
                    ->get();

                $counter = 0;
                foreach ($itemsPortfolio[0] as $itemPortfolio) {
                    \App\Models\Portfolio::where('id', $itemPortfolio->id)
                    ->update([
                        'image' => $portfolioItems[$counter]['image'],
                        'link' => $portfolioItems[$counter]['link'],
                        'text' => $portfolioItems[$counter]['text']
                    ]);
                    $counter++;
                }
            } else {
                foreach ($portfolioItems as $portfolioitem) {
                    $portfolio = new \App\Models\Portfolio();
                    $portfolio->image = $portfolioitem['image'];
                    $portfolio->link = $portfolioitem['link'];
                    $portfolio->text = $portfolioitem['text'];
                    $portfolio->user_id = $id;
                    $portfolio->save();
                }
            }
        } else {
            $scrape['items'] = "no items to update";
        }
        
        //edit user profile
        $request->flash();
        \App\Models\User::where('id', $id)
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

    /* --- HOMEPAGE --- */
    public function showHome()
    {
        //small hardcoded piece for testing emails
        /*$id = session('User');
        $user = \App\Models\User::where('id', $id)->first();
        $internship = \App\Models\Internships::where('city', 'LIKE', $user->city)
        ->where('active', 1)
        ->orderBy('id', 'DESC')
        ->first();

        if (!empty($internship)) {
            $mail = new Email();
            $mail->sendgrid('tim.koenig25@gmail.com', $internship);
        }*/

        return view('home');
    }
}
