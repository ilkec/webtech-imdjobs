<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function searchInternships(Request $request)
    {
        echo $request->type;
        $data['internships'] =  \App\Models\Internships::where('title', 'LIKE', "%" . $request->type . "%")
            ->orwhere('description', 'LIKE', "%" . $request->type . "%")
            ->orwhere('tasks', 'LIKE', "%" . $request->type . "%")
            ->orwhere('profile', 'LIKE', "%" . $request->type . "%")
            ->get();
        dd($data['internships']);
    }

    public function displayInternships()
    {
    }
}
