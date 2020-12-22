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
        //get internships that fullfill filtered criteria
        $data['internships'] =  \App\Models\Internships::where('active', 1)
            ->where('title', 'LIKE', "%" . $request->type . "%")
            ->orwhere('description', 'LIKE', "%" . $request->type . "%")
            ->orwhere('tasks', 'LIKE', "%" . $request->type . "%")
            ->orwhere('profile', 'LIKE', "%" . $request->type . "%")
            ->with('companies')
            ->get();
        //divide filtered data in those for correct city and other cities
        $data['nearbyInternships'] = [];
        $data['otherInternships'] = [];
        if ($request->city) {
            foreach ($data['internships'] as $internship) {
                if (strtolower($internship['city']) == strtolower($request->city)) {
                    $data['nearbyInternships'][] = $internship;
                } else {
                    $data['otherInternships'][]= $internship;
                }
            }
        }
        $data['nearbyInternshipsJSON'] = json_encode($data['nearbyInternships']);
        $data['otherInternshipsJSON'] = json_encode($data['otherInternships']);
        return view('/internship/show', $data);
    }

    /* --- INTERNSHIP DETAILS/APPLY --- */
    public function showInternship($company, $internship, Request $request)
    {
        if ($request->status == null) {
            $url['status'] = "4";
        } else {
            $url['status']=$request->status;
        }
    
        //select all company, internship and application data needed
        $data['company'] = \App\Models\Companies::where('id', $company)->first();
        $data['details'] = \App\Models\Internships::where('id', $internship)->first();
        $data['applications'] = \App\Models\Applications::where('internships_id', $internship)
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->select('applications.id', 'user_id', 'internships_id', 'status', 'companies_id', 'first_name', 'last_name')
            ->get('last_name');
        
        //check if internship is still active
        //dd($data['details']['active']);
        if ($data['details']['active'] == 0) {
            session()->flash('active', 'This internship is not active anymore!');
        }

        //check if user already applied
        $data['applied'] = false;
        $user = Auth::user();
        if ($user) {
            $previousApplication = \App\Models\Applications::where('user_id', $user['id'])
            ->where('id', $internship)
            ->first();
            if ($previousApplication != null) {
                session()->flash('applied', 'You already applied for this internship!');
                $data['applied'] = true;
            }
        } else {
            $data['applied'] = true;
            session()->flash('applied', 'Please log in to apply for this internship!');
        }

        return view('companies/internshipDetails', $data, $url);
    }

    /* --- EDIT INTERNSHIP --- */
    public function editInternship($company, $internship)
    {
        $data['company'] = \App\Models\Companies::where('id', $company)->first();
        $data['internship'] = \App\Models\Internships::where('id', $internship)->first();
        $user = Auth::user();
        //check if user is allowed to edit internship
        if ($user && $user['account_type'] == 0  && $data['company']['user_id'] == $user['id']) {
            return view('companies/internshipEdit', $data);
        }
        return redirect('/');
    }

    public function handleEditInternship(Request $request, $company, $internship)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tasks' => 'required',
            'profile' => 'required',
            'type' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        //edit internship data
        \App\Models\Internships::where('id', $internship)
            ->update([
                'title' => $request->title,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'description' => $request->description,
                'tasks' => $request->tasks,
                'type' => $request->type,
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

        $user = Auth::user();
        //check if user is allowed on create internship page
        if ($user && $user['account_type'] == 0 && $data['company']['user_id'] == $user['id']) {
            return view('/company/addInternship', $data);
        }
        return redirect('/');
    }
  
    public function handleAddInternship(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tasks' => 'required',
            'profile' => 'required',
            'type' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        //save internship
        $internship = new \App\Models\Internships();
        $internship->title = $request->title;
        $internship->postal_code = $request->postal_code;
        $internship->city = $request->city;
        $internship->description = $request->description;
        $internship->tasks = $request->tasks;
        $internship->profile = $request->profile;
        $internship->type = $request->type;
        $internship->active = 1;
        $internship->companies_id = $id;
        $internship->save();

        //get current internships and company and put in array
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $data['internships'] = \App\Models\Internships::where('companies_id', $id)->get();
        return redirect('/companies/' . $id);
    }

    public function deleteInternship($company, $internship)
    {
        $data['company'] = \App\Models\Companies::where('id', $company)->first();
        $data['internship'] = \App\Models\Internships::where('id', $internship)->first();
        $user = Auth::user();
        //check if user is allowed to edit internship
        if ($user && $user['account_type'] == 0  && $data['company']['user_id'] == $user['id']) {
            //dd($data['internship']);
            return view('companies/internshipDelete', $data);
        }
        return redirect('/');
    }

    public function handleDeleteInternship($company, $internship)
    {
        \App\Models\Internships::where('id', $internship)
        ->where('companies_id', $company)
        ->update(['active' => 0]);
        // dd($company);
        return redirect('/companies/' . $company);
    }
}
