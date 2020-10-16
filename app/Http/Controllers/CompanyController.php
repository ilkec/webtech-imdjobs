<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        $data['companies'] = \DB::table('companies')->get();
        return view('companies/index', $data);
    }

    public function show($company){
        $data['details'] = \DB::table('companies')->where('id', $company)->get();
        return view('companies/profile', $data);
    }

    public function indexInternships($company){
        $data['internships'] = \DB::table('internships')->where('company_id', $company)->get();
        return view('companies/internships', $data);
    }

    public function showInternship($internship){
        $data['details'] = \DB::table('internships')->where('id', $internship)->get();
        dd($data);
    }
}
