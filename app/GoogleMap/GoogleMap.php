<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 23.08.17
 * Time: 17:27
 */

namespace App\GoogleMap;

use App\AuthClient;
use App\Transformers\GoogleMapCitiesTransformer;
use Ixudra\Curl\Facades\Curl;
use League\Fractal\Resource\Collection;
use Spatie\Fractal\Fractal;

class GoogleMap
{
    protected $key = 'AIzaSyA1XBqbUTSuldU1JE12XrYANz7sJm90Stk';
    protected $baseHTTP = 'https://maps.googleapis.com/maps/api';

    public function lang()
    {
        return AuthClient::getUser()->getLang();
    }

    public function getCitiesNames($keyword, $countryCode)
    {
        $response = Curl::to(
            $this->baseHTTP . '/place/autocomplete/json?key=' . $this->key .
            '&input=' . $keyword . '&types=(cities)&language=' . $this->lang() . '&components=country:' . $countryCode
        )->get();
        $response = json_decode($response, true);
        $cities = Fractal::create();
        $cities = $cities->collection($response['predictions'])->transformWith(GoogleMapCitiesTransformer::class)->toArray();
        return $cities;

    }

    public function getCityDetailsById($city_id, $lang)
    {
        $response = Curl::to(
            $this->baseHTTP . '/place/details/json?key=' . $this->key .
            '&placeid=' . $city_id . '&language=' . $lang
        )->get();
        $response = json_decode($response, true);
        return ['formatted_address' => $response['result']['formatted_address'],
            'name' => $response['result']['name'],
            'location' =>
                [
                    'lat' => $response['result']['geometry']['location']['lat'],
                    'lng' => $response['result']['geometry']['location']['lng']
                ]
        ];
    }
//
//    public function nearbySearch($location, $radius)
//    {
//        https://maps.googleapis.com/maps/api/place/nearbysearch/output?parameters
//        $response = Curl::to(
//            $this->baseHTTP . '/place/nearbysearch/json?key=' . $this->key .
//            '&types=regions&language=' . $this->lang() . '&location=' . $location['lat'] . ',' . $location['lng'] . '&radius=' . $radius
//        )->get();
//        return $response;
//    }
}