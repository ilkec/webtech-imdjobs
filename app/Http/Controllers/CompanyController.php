<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Foursquare;

class CompanyController extends Controller
{

    public function index()
    {
        $data['companies'] = \DB::table('companies')->get();
        return view('companies/index', $data);
    }

    public function show($company)
    {
        $data['details'] = \DB::table('companies')->where('id', $company)->get();
        return view('companies/profile', $data);
    }

    public function indexInternships($company)
    {
        $data['internships'] = \DB::table('internships')->where('company_id', $company)->get();
        return view('companies/internships', $data);
    }

    public function showInternship($company, $internship)
    {
        $data['details'] = \DB::table('internships')->where('id', $internship)->get();
        //$data['applications'] = \DB::table('applications')->where('internship_id', $internship)->get();
        $data['applications'] = \DB::table('applications')->join('users', 'users.id', '=', 'applications.user_id')->get();
        // $data['users'] = [];
        // foreach ($data['applications'] as $application) {
        //     $user = \DB::table('users')->where('id', $application->user_id)->get();
        //     array_push($data['users'], $user);
        // }
        return view('companies/internshipDetails', $data);
    }

    public function updateApplicationStatus(Request $request)
    {
        echo "yo I'm here";
die();
        \DB::table('applications')->where('id',$id)->update(array(
            'status'=>$selectedValue,
        ));
        return 'success';
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
        $company->users_id = 1; //=====Hard coded: change to session/cookie id once completed
        $company->save();
        $id = $company->id;

        return redirect('/company/update/' . $id);
    }

    public function updateCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $url = "https://api.foursquare.com/v2/venues/search?client_id=4TAFZM0IL2S430ZFFPTO5ILZRM1GLRD2QRELEPDEYIADKF5V&client_secret=1W1UAU1GEYO2E3BA5Q45BT1FNAXNM5P5ZP2JJZ3CBAUCDMBB&v=20180323";
        $addonUrl = "&near=" . $data['company']->city . "&query=" . $data['company']->name;
        $completeUrl = $url . $addonUrl;
        $json = file_get_contents($completeUrl);
        $realjson = json_decode($json);
        $companyData = $realjson->response->venues['0'];
        $data['foursquare'] = $companyData;
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
            //insert picture
            'email' => 'required',
            'phone_number' => "required"
        ]);

        \DB::table('companies')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'city' => $request->city,
                'province' => $request->province,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'description' => $request->description,
                //insert picture
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]);

        return redirect('/company/details/' . $id);
    }

    public function showCompany($id)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        //get current internships and put in array
        $data['internships'] = \App\Models\Internships::where('company_id', $id)->get();
        return view('/company/profile', $data);
    }

    public function addInternshipOffer(Request $request, $id)
    {
        $user = \Auth::user();
        $companies = \App\Models\Companies::find($request->id);
        
        if ($user->can('update', $companies)) {
            $data['user'] = $user;
            $data['company'] = $companies;
            return redirect('/company/addInternship/' . $id);
        } else {
            $request->session()->flash('addInternshipError', 'Something went wrong, you have no access to this company');
            return back();
        }
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
        
        return redirect('/company/profile/' . $id);
    }
}
