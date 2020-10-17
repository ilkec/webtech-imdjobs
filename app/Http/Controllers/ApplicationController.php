<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function addApplication()
    {
        return view('/application/add');
    }

    public function handleAddAplication(Request $request)
    {

        $application = new \App\Models\Applications();
        $application->message = $request->input('message');
        $application->student_id = 1; //=====Hard coded: change to session/cookie id once completed
        $application->interschip_id = 1; //=====Hard coded: change to session/cookie id once completed
        $application->save();

        return redirect('/application/add/');
    }

}
