<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Foursquare;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function addCompany()
    {
        return view('/company/add');
    }

    public function handleAddCompany(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);

        $company = new \App\Models\Companies();
        $company->name = $request->input('name');
        $company->city = $request->input('city');
        $company->users_id = Auth::user()->id;
        $company->save();
        $id = $company->id;

        return redirect('/company/update/' . $id);
    }

    public function updateCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $foursquare = new Foursquare();
        $completeUrl = $foursquare->getUrl($data);
        $response = $foursquare->getResult($completeUrl);
        $data['foursquare'] = $foursquare->setData($response);
        return view('/company/update', $data);
    }

    public function handleUpdateCompany(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'description' => 'required',
            'image' => 'required',
            'email' => 'required',
            'phone_number' => "required"
        ]);

        $imagePath = $request->image->store('images', 'public');

        DB::table('companies')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                'picture' => $imagePath,
                'email' => $request->email,
                'phone_number' => $request->phone_number
                ]);

        return redirect('/company/profile/' . $id);
    }

    public function showCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //get current internships and put in array
        $data['internships'] = \App\Models\Internships::where('company_id', $id)->get();
        return view('/company/profile', $data);
    }

    public function addInternshipOffer(Request $request, $id)
    {
        $user = Auth::user();
        $companies = \App\Models\Companies::find($request->id);
        
        if ($user->can('update', $companies)) {
            $data['user'] = $user;
            $data['company'] = $companies;
            return redirect('/company/addInternship/' . $id);
        } else {
            $request->session()->flash('addInternshipError', 'Something went wrong, you have no access to this company');
            return back();
        }
    }

    public function addInternship($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        return view('/company/addInternship', $data);
    }

    public function handleAddInternship(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tasks' => 'required',
            'profile' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        $internship = new \App\Models\Internships();
        $internship->title = $request->title;
        $internship->postal_code = $request->postal_code;
        $internship->city = $request->city;
        $internship->description = $request->description;
        $internship->tasks = $request->tasks;
        $internship->profile = $request->profile;
        $internship->active = 1;
        $internship->company_id = $id;
        $internship->save();
        
        return redirect('/company/profile/' . $id);
    }
}
