<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /* --- ADD APPLICATIONS --- */
    public function addApplication($company, $internship)
    {
        $data['applied'] = false;
        $user = Auth::user();
        $previousApplication = null;
        if ($user) {
            //check if user already applied
            $previousApplication = \App\Models\Applications::where('user_id', $user['id'])
            ->where('id', $internship)
            ->first();

            //if already applied
            if ($previousApplication != null) {
                session()->flash('applied', 'You already applied for this internship!');
                $data['applied'] = true;
                return redirect('/companies/' . $company . '/internships/' . $internship);
            }
            //if not applied yet
            return view('/application/add');
        }
        //if no user logged in
        $data['applied'] = true;
        session()->flash('applied', 'Please log in to apply for this internship!');
        return redirect('/companies/' . $company . '/internships/' . $internship);
    }

    public function handleAddAplication($company, $internship, Request $request)
    {
        $studentId = session('User');
        //save application
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

    //* --- EDIT APPLICATIONS (accept, decline, ...) --- */
    public function editApplication($company, $application)
    {
        $user = Auth::user();
        // find application to edit
        $data['application'] =  \App\Models\Applications::where('id', $application)->with('companies')->first();

        //check if logged in and employer
        if ($user && $user['account_type'] == 0 && $data['application']->companies->user_id == $user['id']) {
            return view('/application/edit', $data);
        }
        return redirect('/');
    }

    public function handleEditAplication($company, $application, Request $request)
    {
        $status = $request->status;
        $feedback = $request->feedback;

        // edit application
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

    /* --- SHOW APPLICATIONS --- */
    public function showApplications()
    {
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->first();
        if($data['users']['account_type'] == 1){
        // get applications for user
        $data['applicationsUser'] = \App\Models\Applications::join('internships', 'internships.id', '=', 'applications.internships_id')
            ->join('companies', 'companies.id', '=', 'applications.companies_id')
            ->where('applications.user_id', $id)
            ->get();
        } else {
        $userCompanies = \App\Models\Companies::where('user_id', $id)->get('id');
        $data['applicationsCompany'] = \App\Models\Applications::join('internships', 'internships.id', '=', 'applications.internships_id')
            ->join('companies', 'companies.id', '=', 'applications.companies_id')
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->where('applications.companies_id', $userCompanies[0]['id'])->get();
        }
        // check if user is logged in
        if ($id == null) {
            session()->flash('login', 'Please log in to see the internships you applied for!');
        }
        return view('/user/applications', $data);
    }
}
