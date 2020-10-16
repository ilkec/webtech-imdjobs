<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function addCompany()
    {
        return view('/company/add');
    }
}
