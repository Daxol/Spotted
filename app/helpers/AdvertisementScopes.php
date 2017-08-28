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
use Carbon\Carbon;

trait AdvertisementScopes
{
    public function scopeCountry($query, $country)
    {
        return $query->whereCountry($country);
    }

    public function scopeCity($query, $city)
    {
        return $query->where('city_pl', $city)->orWhere('city_en', $city);
    }

    public function scopePlace($query, $place)
    {
        return $query->where('place_id', $place);
    }

    public function scopeDate_from($query, $date_from)
    {
        return $query->whereDate('created_at', '>=', Carbon::parse($date_from)->format('Y-m-d'));
    }

    public function scopeDate_until($query, $date_until)
    {
        return $query->whereDate('created_at', '<=', Carbon::parse($date_until)->format('Y-m-d'));
    }

    public function scopeCategory($query, $category)
    {
        return $query->whereCategory($category);
    }

    public function scopeStatus($query, $status)
    {
        return $query->whereStatus($status);
    }


    public function scopeKeywords($query, $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%')->orWhere('content', 'LIKE', '%' . $title . '%');
    }
}