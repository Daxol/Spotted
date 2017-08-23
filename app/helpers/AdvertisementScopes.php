<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 21.08.17
 * Time: 19:02
 */

namespace App\helpers;

use App\Advertisement;
use App\GoogleMap\GoogleMap;

trait AdvertisementScopes
{
    public function scopeCountry($query, $country)
    {
        return $query->whereCountry($country);
    }

    public function scopeCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopePlace($query, $place)
    {

        return $query->where('place_id', $place);
    }

    public function scopeCategory($query, $category)
    {
        return $query->whereCategory($category);
    }

    public function scopeKeywords($query, $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%')->orWhere('content', 'LIKE', '%' . $title . '%');
    }
}