<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 21.08.17
 * Time: 19:02
 */

namespace App\helpers;

use App\Advertisement;

trait AdvertisementScopes
{
    public function scopeCountry($query, $country)
    {
        return $query->whereCountry($country);
    }

    public function scopeCity($query, $city, $distance = 0)
    {
        return $query->whereCity($city);
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