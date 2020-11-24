<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Foursquare;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $data['companies'] = \App\Models\Companies::all();
        $data['user'] = Auth::user();
        return view('companies/index', $data);
    }

    public function show($company)
    {
        $data['company'] =  \App\Models\Companies::where('id', $company)->first();
        //get current internships and put in array
        $data['internships'] = \App\Models\Internships::where('company_id', $company)->get();
        return view('/companies/profile', $data);
    }

    public function indexInternships($company)
    {
        $data['internships'] = DB::table('internships')->where('company_id', $company)->get();
        
        return view('companies/internships', $data);
    }

    public function showInternship($company, $internship, Request $request)
    {
        if ($request->status == null) {
            $url['status'] = "4";
        } else {
            $url['status']=$request->status;
        }
    
        $data['company'] = \App\Models\Companies::where('id', $company)->first();

        $data['details'] = DB::table('internships')->where('id', $internship)->get();
        $data['applications'] = DB::table('applications')->where('internship_id', $internship)
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->select('applications.id', 'user_id', 'internship_id', 'status', 'company_id', 'first_name', 'last_name')
            ->get('last_name');

        return view('companies/internshipDetails', $data, $url);
    }

    public function addCompany()
    {
        return view('/company/add');
    }

    public function handleAddCompany(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'city' => 'required'
        ]);

        $company = new \App\Models\Companies();
        $company->name = $request->input('name');
        $company->city = $request->input('city');
        $company->users_id = Auth::user()->id;
        $company->save();
        $id = $company->id;

        return redirect('/company/update/' . $id);
    }

    public function updateCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $foursquare = new Foursquare();
        $completeUrl = $foursquare->getUrl($data);
        $response = $foursquare->getResult($completeUrl);
        $data['foursquare'] = $foursquare->setData($response);
        return view('/company/update', $data);
    }

    public function handleUpdateCompany(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'description' => 'required',
            'email' => 'required',
            'phone_number' => "required",
            'website' => "required"
        ]);

        $imagePath = $request->image->store('images', 'public');

        \App\Models\Companies::where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                'picture' => $imagePath,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'website' => $request->website
            ]);

        return redirect('/companies/' . $id);
    }

    public function showCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //get current internships and put in array
        $data['internships'] = \App\Models\Internships::where('company_id', $id)->get();
        return view('/companies/profile', $data);
    }

    public function editCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        return view('/companies/edit', $data);
    }

    public function handleEditCompany(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'description' => 'required',
            'email' => 'required',
            'phone_number' => "required",
            'website' => "required"
        ]);
        $imagePath ="";
        if (!empty($request->image)) {
            $imagePath = $request->image->store('images', 'public');
        } else {
            $data['company'] = \App\Models\Companies::where('id', $id)->first();
            $imagePath = $data['company']->picture;
        }

        \App\Models\Companies::where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                'picture' => $imagePath,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'website' => $request->website
            ]);

        return redirect('/companies/' . $id);
    }

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

    public function filterCompanies(Request $request)
    {
        $validation = $request->validate([
            'Company' => 'required'
        ]);

        $data['companies'] =  \App\Models\Companies::where('name', 'LIKE', "%" . $request->Company . "%")
        ->orwhere('description', 'LIKE', "%" . $request->Company . "%")
        ->orwhere('city', 'LIKE', "%" . $request->Company . "%")
        ->get();

        $data['user'] = Auth::user();
        return view('companies/index', $data);
    }

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
}
