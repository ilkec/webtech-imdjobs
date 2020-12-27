<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
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
            ->where('type', $request->type)
            ->orwhere('title', 'LIKE', "%" . $request->type . "%")
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
        //return view('/internship/show', $data);
        return view('/', $data);
    }
}
