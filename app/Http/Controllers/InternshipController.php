<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternshipController extends Controller
{
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
        if ($request->city) {
            foreach ($data['internships'] as $internship) {
                if (strtolower($internship['city']) == strtolower($request->city)) {
                    $data['nearbyInternships'][] = $internship;
                }
            }
        }
        return view('/internship/show', $data);
    }

    public function displayInternships()
    {
    }
}