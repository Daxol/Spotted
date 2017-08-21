<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 21.08.17
 * Time: 19:02
 */

namespace App\helpers;

use App\Advertisement;

class AdvertisementStatus
{
    public static function changeStatus($advertisement_id, $status)
    {
        try {
            $advertisement = Advertisement::findOrFail($advertisement_id);
            if ($status < 0 || $status > 5) {
                return response()->json(['error' => 'status is incorrect']);
            }
            $advertisement->status = $status;
            $advertisement->save();
            return response()->json(['msg' => 'status changed successfully']);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'error'], 304);
        }
    }
}