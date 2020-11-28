<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    /* --- SEARCH FILTER INTERNSHIPS --- */
    public function searchInternships(Request $request)
    {
        $validation = $request->validate([
            'type' => 'required',
            'city' => 'required'
        ]);
        $data['internships'] =  \App\Models\Internships::where('title', 'LIKE', "%" . $request->type . "%")
            ->orwhere('description', 'LIKE', "%" . $request->type . "%")
            ->orwhere('tasks', 'LIKE', "%" . $request->type . "%")
            ->orwhere('profile', 'LIKE', "%" . $request->type . "%")
            ->get();
        
        $data['nearbyInternships'] = [];
        $data['otherInternships'] = [];
        $data['companies'] = [];
        if ($request->city) {
            foreach ($data['internships'] as $internship) {
                if (strtolower($internship['city']) == strtolower($request->city)) {
                    $data['nearbyInternships'][] = $internship;
                } else {
                    $data['otherInternships'][]= $internship;
                }
                $company = \App\Models\Companies::where('id', $internship['company_id'])->first();
                if (!in_array($company, $data['companies'])) {
                    $data['companies'][] = $company;
                }
            }
        }
        //dd($data['companies']);
        return view('/internship/show', $data);
    }

    /* --- ALL INTERNSHIPS OF COMPANY --- */
    public function indexInternships($company)
    {
        $data['internships'] = \App\Models\Internships::where('company_id', $company)->get();
        return view('companies/internships', $data);
    }

    /* --- INTERNSHIP DETAILS/APPLY --- */
    public function showInternship($company, $internship, Request $request)
    {
        if ($request->status == null) {
            $url['status'] = "4";
        } else {
            $url['status']=$request->status;
        }
    
        $data['company'] = \App\Models\Companies::where('id', $company)->first();
        $data['details'] = \App\Models\Internships::where('id', $internship)->get();
        $data['applications'] = \App\Models\Applications::where('internship_id', $internship)
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->select('applications.id', 'user_id', 'internship_id', 'status', 'company_id', 'first_name', 'last_name')
            ->get('last_name');

        return view('companies/internshipDetails', $data, $url);
    }

    /* --- EDIT INTERNSHIP --- */
    public function editInternship($company, $internship)
    {
        $data['company'] = \App\Models\Companies::where('id', $company)->first();
        $data['internship'] = \App\Models\Internships::where('id', $internship)->first();
        return view('companies/internshipEdit', $data);
    }

    public function handleEditInternship(Request $request, $company, $internship)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tasks' => 'required',
            'profile' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        \App\Models\Internships::where('id', $internship)
            ->update([
                'title' => $request->title,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'description' => $request->description,
                'tasks' => $request->tasks,
                'profile' => $request->profile
            ]);

        return redirect('/companies/' . $company);
    }

    /* --- ADD INTERNSHIP --- */
    public function addInternshipOffer(Request $request, $id)
    {
        $user = Auth::user();
        $companies = \App\Models\Companies::find($request->id);
        $data['user'] = $user;
        $data['company'] = $companies;
        return redirect('/company/addInternship/' . $id);
    }
    
    public function addInternship($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        return view('/company/addInternship', $data);
    }
  
    public function handleAddInternship(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tasks' => 'required',
            'profile' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        $internship = new \App\Models\Internships();
        $internship->title = $request->title;
        $internship->postal_code = $request->postal_code;
        $internship->city = $request->city;
        $internship->description = $request->description;
        $internship->tasks = $request->tasks;
        $internship->profile = $request->profile;
        $internship->active = 1;
        $internship->company_id = $id;
        $internship->save();

        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //get current internships and put in array
        $data['internships'] = \App\Models\Internships::where('company_id', $id)->get();
        return redirect('/companies/' . $id);
    }
}
