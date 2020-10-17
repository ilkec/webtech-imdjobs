<?php
namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class Foursquare
{
    $url = "https://api.foursquare.com/v2/venues/explore?client_id=CLIENT_ID&client_secret=CLIENT_SECRET&v=20180323&limit=1&ll=40.7243,-74.0018&query=coffee";
    $json = file_get_contents($url);
    $elements = json_decode($json);
    var_dump($elements);
}
