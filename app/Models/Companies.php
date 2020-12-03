<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'city'
    ];

     //company behoort tot 1 user
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }

     //company heeft meerder interships
    public function internship(){
        return $this->hasMany('\App\Models\Internships');
    }

     //company kan meerdere applications binnenkrijgen
    public function application(){
        return $this->hasMany('\App\Models\Applications');
    }
}
