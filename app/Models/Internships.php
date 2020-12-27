<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internships extends Model
{
    use HasFactory;

    //intership belongs to 1 specific company only
    public function companies()
    {
        return $this->belongsTo('\App\Models\Companies');
    }

    //internship can have multiple applications
    public function application()
    {
        return $this->hasMany('\App\Models\Applications');
    }
}
