<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function addApplication()
    {
        return view('/application/add');
    }

    public function handleAddAplication($company, $internship, Request $request)
    {
        $studentId = session('User');
        
        //validate if exists

        //save
        $application = new \App\Models\Applications();
        $application->user_id = $studentId; 
        $application->internship_id = $internship;
        $application->company_id = $company;
        $application->status = 0;
        $application->message = $request->input('message');
        $application->feedback = "";
        $application->save();

        return redirect('/companies/' . $company . '/internships/' . $internship);
    }

    //Edit application status
    public function editApplication() 
    {
        return view('/application/edit');
    }

    public function handleEditAplication($company, $application, Request $request)
    {
        echo $request;
        $status = $request->status;
        $feedback = $request->feedback;

        DB::table('applications')
        ->where('id', $application )
        ->update([
            'status' => $status,
            'feedback' => $feedback
        ]);

    return redirect('/company/'. $company .'/internships/');
    }


}
