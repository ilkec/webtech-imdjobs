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

     //company belongs to 1 specific user only
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }

     //company can have multiple internships
    public function internship(){
        return $this->hasMany('\App\Models\Internships');
    }

     //company can have multiple applications
    public function application(){
        return $this->hasMany('\App\Models\Applications');
    }
}
