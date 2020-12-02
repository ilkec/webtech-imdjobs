<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Foursquare;
use App\Classes\DeLijn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /* --- ALL COMPANIES --- */
    public function index()
    {
        $data['companies'] = \App\Models\Companies::all();
        $data['user'] = Auth::user();
        return view('companies/index', $data);
    }

    /* --- COMPANY DETAILS --- */
    public function showCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //get current internships and put in array
        $data['internships'] = \App\Models\Internships::where('companies_id', $id)->get();
        return view('/companies/profile', $data);
    }

    /* --- ADD COMPANIES --- */
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
        $company->user_id = Auth::user()->id;
        $company->save();
        $id = $company->id;

        return redirect('/company/update/' . $id);
    }

    /* --- UPDATE COMPANIES --- */
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
            'email' => 'required',
            'phone_number' => "required",
            'website' => "required"
        ]);
        $imagePath = "";
        if (!empty($request->image)) {
            $imagePath = $request->image->store('images', 'public');
        }

        $data['street_address'] = $request->street_address;
        $data['city'] = $request->city;
        $deLijn = new DeLijn();
        $completeUrl = $deLijn->getUrl($data['street_address'], $data['city']);
        $response = json_decode($deLijn->getResult($completeUrl), true);
        $data['deLijn'] = $deLijn->setData($response);


        if ($data['deLijn']) {
            $haltenummer = $data['deLijn']['haltenummer'];
            $halte_omschrijving = $data['deLijn']['omschrijving'];
        } else {
            $haltenummer = "";
            $halte_omschrijving = "";
        }

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
        return view('/companies/edit', $data);
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

        $data['companies'] =  \App\Models\Companies::where('name', 'LIKE', "%" . $request->Company . "%")
            ->orwhere('description', 'LIKE', "%" . $request->Company . "%")
            ->orwhere('city', 'LIKE', "%" . $request->Company . "%")
            ->get();

        $data['user'] = Auth::user();
        return view('companies/index', $data);
    }
}
