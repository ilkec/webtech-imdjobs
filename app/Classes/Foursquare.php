<?php
namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class Foursquare
{
    public function getUrl($data)
    {
        $url = "https://api.foursquare.com/v2/venues/search?client_id=4TAFZM0IL2S430ZFFPTO5ILZRM1GLRD2QRELEPDEYIADKF5V&client_secret=1W1UAU1GEYO2E3BA5Q45BT1FNAXNM5P5ZP2JJZ3CBAUCDMBB&v=20180323";
        $addonUrl = "&near=" . $data['company']->city . "&query=" . $data['company']->name;
        $completeUrl = $url . $addonUrl;
        return $completeUrl;
    }

    public function getResult($completeUrl)
    {
        try {
            $response = Http::get($completeUrl)->json();
        } catch (\Exception $e) {
            $response = "";
        }
        return $response;
    }

    public function setData($response, $company)
    {
        if ($response != "") {
            if(!empty($response['response']['venues']['0'])) {
                $APIresonse = strtolower($response['response']['venues'][0]['name']);
                $companyRespronse = strtolower($company);
            }
            
            if (!empty($response['response']['venues']['0']) && str_contains($APIresonse, $companyRespronse) ) {
                if($APIresonse != $companyRespronse) {
                    session()->flash('questionableCompany', 'Did you mean ' . $response['response']['venues'][0]['name']);
                }
                return $response['response']['venues']['0'];
            }
        }
        session()->flash('noCompany', 'We could not find the company you are looking for, please complete this form about the company!');
        return "";
    }
}
