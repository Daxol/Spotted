<?php

namespace App\Http\Controllers\Advertisement;

use App\helpers\AdvertisementStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdvertisementStatusController extends Controller
{
    public function update(Request $request, $advertisement, $status)
    {

        return AdvertisementStatus::changeStatus($advertisement, $status);

    }
}
