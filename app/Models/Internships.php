<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internships extends Model
{
    use HasFactory;

    //intership behoort maar tot 1 company
    public function companies()
    {
        return $this->belongsTo('\App\Models\Companies');
    }

    public function application()
    {
        return $this->hasMany('\App\Models\Applications');
    }
}
