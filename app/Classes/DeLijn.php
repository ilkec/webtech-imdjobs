<?php
namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class DeLijn
{
    public function getUrl($street, $city)
    {
        $url = "https://api.delijn.be/DLZoekOpenData/v1/zoek/locaties/";
        $street_address = preg_replace('/\d/', '', $street);
        $addonUrl = $street_address . " " . $city . "?startIndex=0&maxAantalHits=1";
        $completeUrl = $url . $addonUrl;
        return $completeUrl;
    }

    public function getResult($completeUrl)
    {
        try {
            $response = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => '29dc02ea7b0c4b29a13926724b6af7a4'
            ])->get($completeUrl)->body();;
        } catch (\Exception $e) {
            $response = "";
        }
        return $response;
    }

    public function setData($response)
    {
        if ($response != "") {
            if (!empty($response['locaties'][0])) {
                return $response['locaties'][0];
            }
        }
        return "";
    }
}
