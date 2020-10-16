<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Foursquare;

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
        $company->users_id = 1; //=====Hard coded: change to session/cookie id once completed
        $company->save();
        $id = $company->id;

        return redirect('/company/update/' . $id);
    }

    public function updateCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $url = "https://api.foursquare.com/v2/venues/search?client_id=4TAFZM0IL2S430ZFFPTO5ILZRM1GLRD2QRELEPDEYIADKF5V&client_secret=1W1UAU1GEYO2E3BA5Q45BT1FNAXNM5P5ZP2JJZ3CBAUCDMBB&v=20180323";
        $addonUrl = "&near=" . $data['company']->city . "&query=" . $data['company']->name;
        $completeUrl = $url . $addonUrl;
        $json = file_get_contents($completeUrl);
        $realjson = json_decode($json);
        $companyData = $realjson->response->venues['0'];
        $data['foursquare'] = $companyData;
        return view('/company/update', $data);
    }

    public function handleUpdateCompany(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'description' => 'required',
            //insert picture
            'email' => 'required',
            'phone_number' => "required"
        ]);
        
        \DB::table('companies')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                //insert picture
                'email' => $request->email,
                'phone_number' => $request->phone_number
                ]);

        return redirect('/company/details/' . $id);
    }
}
