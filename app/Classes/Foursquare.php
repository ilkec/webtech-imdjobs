<?php
namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class Foursquare
{
    public function getUrl($id, $data)
    {
        $data['company'] =  \App\Models\Companies::where('id', $id)->first();
        $url = "https://api.foursquare.com/v2/venues/search?client_id=4TAFZM0IL2S430ZFFPTO5ILZRM1GLRD2QRELEPDEYIADKF5V&client_secret=1W1UAU1GEYO2E3BA5Q45BT1FNAXNM5P5ZP2JJZ3CBAUCDMBB&v=20180323";
        $addonUrl = "&near=" . $data['company']->city . "&query=" . $data['company']->name;
        $completeUrl = $url . $addonUrl;
        return $completeUrl;
    }
}
