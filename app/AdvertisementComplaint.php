<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AdvertisementComplaint extends Model
{
    protected $fillable = ['content', 'type', 'user_id', 'advertisement_id'];


    public static function createComplaint($data, $advertisement_id)
    {
        try {
            $advertisement = Advertisement::findOrFail($advertisement_id);
            $user = AuthClient::getUser();
            $lastReport = $user->advertisementComplaints()->where('created_at', '>',
                Carbon::now()
                    ->subMinutes(2)
                    ->toDateTimeString())
                ->get();
            $lastMonthReports = $user->advertisementComplaints()->where('created_at', '>',
                Carbon::now()
                    ->subDays(1)
                    ->toDateTimeString())
                ->get();
            error_log(count($lastReport) . " " . count($lastMonthReports));
            if (count($lastReport) >= 1 ||count($lastMonthReports)  >= 5) {
                return response()->json(['error' => 'limit of reports'], 304);
            }
            $advertisementComplaint = new AdvertisementComplaint(
                [
                    'content' => $data['content'],
                    'type' => $data['type'],
                    'user_id' => AuthClient::getUserId()

                ]);
            $advertisement->advertisementComplaint()->save($advertisementComplaint);
            return response()->json(['msg' => 'advertisement complaint created', 'status' => 'ok']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function user()
    {
        return $this->belongsTo(Advertisement::class);
    }


}
