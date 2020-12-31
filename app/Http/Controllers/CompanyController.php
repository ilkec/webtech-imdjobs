<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Foursquare;
use App\Classes\DeLijn;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /* --- ALL COMPANIES --- */
    public function index()
    {
        //get all companies
        $data['user'] = Auth::user();
        if ($data['user']) {
            $data['mycompanies'] = \App\Models\Companies::where('user_id', $data['user']->id)->get();
        }
        return view('companies/index', $data);
    }

    /* --- COMPANY DETAILS --- */
    public function showCompany($id)
    {
        //get company
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //get current internships of this company
        $data['internships'] = \App\Models\Internships::where('companies_id', $id)->where('active', 1)->get();
        return view('/companies/profile', $data);
    }

    /* --- ADD COMPANIES --- */
    public function addCompany()
    {
        $user = Auth::user();
        //check if user is allowed to add companies
        if ($user && $user['account_type'] == 0) {
            return view('/company/add');
        }
        return redirect('/');
    }

    public function handleAddCompany(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);
        
        //save company
        $company = new \App\Models\Companies();
        $company->name = $request->input('name');
        $company->city = $request->input('city');
        $company->user_id = Auth::user()->id;
        $company->save();
        $id = $company->id;

        return redirect('/company/update/' . $id);
    }

    /* --- UPDATE COMPANIES --- */
    public function updateCompany($id)
    {
        $user = Auth::user();
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //check if user has access to update page
        if (!$user || $user['account_type'] != 0 || $data['company']['user_id'] != $user['id']) {
            return redirect('/');
        }
        $foursquare = new Foursquare();
        $completeUrl = $foursquare->getUrl($data);
        $response = $foursquare->getResult($completeUrl);
        $data['foursquare'] = $foursquare->setData($response, $data['company']['name']);
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
            'email' => 'required',
            'phone_number' => "required",
            'website' => "required"
        ]);
        $imagePath = "";
        if (!empty($request->image)) {
            $imagePath = $request->image->store('images', 'public');
        }

        //get public transport nearby company
        $data['street_address'] = $request->street_address;
        $data['city'] = $request->city;
        $deLijn = new DeLijn();
        $completeUrl = $deLijn->getUrl($data['street_address'], $data['city']);
        $response = json_decode($deLijn->getResult($completeUrl), true);
        $data['deLijn'] = $deLijn->setData($response);
        $haltenummer = "";
        $halte_omschrijving = "";

        if (isset($data['deLijn']['haltenummer'])) {
            $haltenummer = $data['deLijn']['haltenummer'];
            $halte_omschrijving = $data['deLijn']['omschrijving'];
        }

        //save company update
        \App\Models\Companies::where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                'picture' => $imagePath,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'website' => $request->website,
                'haltenummer' => $haltenummer,
                'halte_beschrijving' => $halte_omschrijving
            ]);

        return redirect('/companies/' . $id);
    }

    /* --- EDIT COMPANIES --- */
    public function editCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $user = Auth::user();
        //check if user has access to edit page
        if ($user && $user['account_type'] == 0 && $data['company']['user_id'] == $user['id']) {
            return view('/companies/edit', $data);
        }
        return redirect('/');
    }

    public function handleEditCompany(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'description' => 'required',
            'email' => 'required',
            'phone_number' => "required",
            'website' => "required"
        ]);
        $imagePath = "";
        if (!empty($request->image)) {
            $imagePath = $request->image->store('images', 'public');
        } else {
            $data['company'] = \App\Models\Companies::where('id', $id)->first();
            $imagePath = $data['company']->picture;
        }

        //edit company
        \App\Models\Companies::where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                'picture' => $imagePath,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'website' => $request->website
            ]);

        return redirect('/companies/' . $id);
    }

    /* --- FILTER COMPANIES --- */
    public function filterCompanies(Request $request)
    {
        $validation = $request->validate([
            'Company' => 'required'
        ]);

        //get city or Company name
        $data['request'] = $request->Company;
        //get companies that fullfill filtered criteria
        $data['companies'] =  \App\Models\Companies::where('name', 'LIKE', "%" . $request->Company . "%")
            ->orwhere('description', 'LIKE', "%" . $request->Company . "%")
            ->orwhere('city', 'LIKE', "%" . $request->Company . "%")
            ->get();

        $data['user'] = Auth::user();
        if ($data['user']) {
            $data['mycompanies'] = \App\Models\Companies::where('user_id', $data['user']->id)->get();
        }
        return view('companies/index', $data);
    }
}
