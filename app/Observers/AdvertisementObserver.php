<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 23.08.17
 * Time: 21:17
 */

namespace App\Observers;

use App\Advertisement;
use App\GoogleMap\GoogleMap;

class AdvertisementObserver
{
    public function creating(Advertisement $advertisement)
    {
        $place = $advertisement->place_id;
        $map = new GoogleMap();
        $city_pl = $map->getCityDetailsById($place, 'pl')['name'];
        $city_en = $map->getCityDetailsById($place, 'en')['name'];

        $advertisement->city_pl = $city_pl;
        $advertisement->city_en = $city_en;
    }
}