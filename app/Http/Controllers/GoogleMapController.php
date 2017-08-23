<?php

namespace App\Http\Controllers;

use App\GoogleMap\GoogleMap;
use Illuminate\Http\Request;

class GoogleMapController extends Controller
{
    public function searchCities($keyword, $lang)
    {
        try {
            $googleMap = new GoogleMap();
            return $googleMap->getCitiesNames($keyword, $lang);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function getCityDetails($id, $lang)
    {
        try {
            $googleMap = new GoogleMap();

         return   $googleMap->getCityDetailsById($id, $lang);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }
}
