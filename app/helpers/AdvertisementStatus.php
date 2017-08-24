<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 21.08.17
 * Time: 19:02
 */

namespace App\helpers;

use App\Advertisement;
use App\AuthClient;

class AdvertisementStatus
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PREMIUM = 2;
    const STATUS_CLOSED = 3;

    public static function changeStatus($advertisement_id, $status)
    {
        try {
            $advertisement = Advertisement::findOrFail($advertisement_id);
            if (!self::checkUserPermission($advertisement)) {
                return response()->json(['error' => 'not authorized'], 401);
            }
            if ($advertisement->status == self::STATUS_BLOCKED || $advertisement->status == self::STATUS_CLOSED) {
                return response()->json(['error' => 'cannot change status because advertisement is not active'], 304);
            }
            if ($status < self::STATUS_BLOCKED || $status > self::STATUS_CLOSED) {
                return response()->json(['error' => 'status is incorrect']);
            }
            $advertisement->status = $status;
            $advertisement->save();

            return response()->json(['msg' => 'status changed successfully']);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'error, status has not changed'], 304);
        }
    }

    protected static function checkUserPermission($advertisement)
    {
        if ($advertisement->user_id != AuthClient::getUserId() && AuthClient::getUser()->user_rank != 9) {
            return false;
        }
        return true;
    }
}