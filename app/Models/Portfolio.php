<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'portfolio'; //defines which table to store data to - normally a portfolio model will store in portfolios table
   
     //portfolio item belongs to 1 specific user only
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
