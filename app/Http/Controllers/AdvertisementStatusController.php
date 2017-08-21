<?php

namespace App\Http\Controllers;

use App\helpers\AdvertisementStatus;
use Illuminate\Http\Request;

class AdvertisementStatusController extends Controller
{
    public function update(Request $request, $advertisement, $status)
    {

        return AdvertisementStatus::changeStatus($advertisement, $status);

    }
}
