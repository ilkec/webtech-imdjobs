<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internships extends Model
{
    use HasFactory;

     //intership behoort maar tot 1 company
    public function company(){
        return $this->belongsTo('\App\Models\Company');
    }
}
