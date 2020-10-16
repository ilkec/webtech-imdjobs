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
        $url = "https://api.foursquare.com/v2/venues/search?near=Brussels&query=HUNTRS&client_id=4TAFZM0IL2S430ZFFPTO5ILZRM1GLRD2QRELEPDEYIADKF5V&client_secret=1W1UAU1GEYO2E3BA5Q45BT1FNAXNM5P5ZP2JJZ3CBAUCDMBB&v=20180323";
        $json = file_get_contents($url);
        $elements = json_decode($json);
        var_dump($elements);
        //$data['foursquare'] =
        //return view('/company/update', $data);
    }
}
