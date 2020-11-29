<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'portfolio'; //defines which table to store data to - normally a portfolio model will store in portfolios table
   
     //portfolioitem behoort tot 1 specifieke user
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
