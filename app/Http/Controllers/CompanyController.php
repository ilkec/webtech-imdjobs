<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('/company/update', $data);
    }
}
