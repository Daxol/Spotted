<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 23.08.17
 * Time: 19:09
 */

namespace App\helpers;


trait CountryCodes
{

    public static function getCode($country)
    {
        $countries = array
        (
            'AR' => 'Argentina',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'BE' => 'Belgium',
            'BR' => 'Brazil',
            'BG' => 'Bulgaria',
            'CL' => 'Chile',
            'CN' => 'China',
            'HR' => 'Croatia',
            'CZ' => 'Czech Republic',
            'FI' => 'Finland',
            'FR' => 'France',
            'DE' => 'Germany',
            'GR' => 'Greece',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'IE' => 'Ireland',
            'IT' => 'Italy',
            'NL' => 'Netherlands',
            'NO' => 'Norway',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'RU' => 'Russian Federation',
            'RS' => 'Serbia',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'ES' => 'Spain',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
        );

        $key = array_search($country, $countries);
        return $key;

    }
}