<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementComplaint extends Model
{
    protected $fillable = ['content', 'type', 'user_id', 'advertisement_id'];


    public static function createComplaint($data, $advertisement_id)
    {
        try {
            $advertisement = Advertisement::findOrFail($advertisement_id);
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
