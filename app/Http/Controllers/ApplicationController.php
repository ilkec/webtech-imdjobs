<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function addApplication()
    {
        //check if user already applied
        /*$data['applied'] = false;
        $user = Auth::user();
        $previousApplication = \App\Models\Applications::where('user_id', $user['id'])
             ->where('id', $internship)
             ->first();
        if ($previousApplication != null) {
            return;
        }*/
        return view('/application/add');
    }

    public function handleAddAplication($company, $internship, Request $request)
    {
        $studentId = session('User');
        
        //validate if exists

        //save
        $application = new \App\Models\Applications();
        $application->user_id = $studentId;
        $application->internships_id = $internship;
        $application->companies_id = $company;
        $application->status = 0;
        $application->message = $request->input('message');
        $application->feedback = "";
        $application->save();

        return redirect('/companies/' . $company . '/internships/' . $internship);
    }

    //Edit application status
    public function editApplication($company, $internship)
    {
        $studentId = session('User');
        $data['application'] =  \App\Models\Applications::where('user_id', $studentId)
            ->where('id', $internship)
            ->get();
        return view('/application/edit');
    }

    public function handleEditAplication($company, $application, Request $request)
    {
        echo $request;
        $status = $request->status;
        $feedback = $request->feedback;

        \App\Models\Applications::where('id', $application)
            ->update([
                'status' => $status,
                'feedback' => $feedback
            ]);

        $application_id =  \App\Models\Applications::where('id', $application)
            ->select('internships_id')
            ->first();

        return redirect('/companies/'. $company .'/internships/' . $application_id['internships_id']);
    }
    
    public function showApplications()
    {
        $id = session('User');
        $data['applications'] = \App\Models\Applications::join('internships', 'internships.id', '=', 'applications.internships_id')
            ->join('companies', 'companies.id', '=', 'applications.companies_id')
            ->where('applications.user_id', $id)
            ->get();
        return view('/user/applications', $data);
    }
}
