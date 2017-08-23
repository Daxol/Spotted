<?php

namespace App;

use App\helpers\AdvertisementStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\helpers\AdvertisementScopes;

class Advertisement extends Model
{
    use AdvertisementScopes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisementComplaint()
    {
        return $this->hasMany(AdvertisementComplaint::class);
    }

    public function advertisementComment()
    {
        return $this->hasMany(AdvertisementComment::class);
    }

    public static function store($data)
    {
        try {
            $newAdvertisement = new Advertisement($data);
            $newAdvertisement->save();
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
        return response()->json(['msg' => 'Advertisement created'], 201);
    }


    public static function updateAdvertisement($id, $data)
    {
        try {
            $advertisement = Advertisement::findOrFail($id);
            $advertisement->update($data);
            return response()->json(['msg' => 'advertisement has been updated']);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'no advertisement for id ' . $id], 304);
        }
    }

    public static function deactiveAdvertisement($id)
    {
        return AdvertisementStatus::changeStatus($id, 0);
    }

    protected $fillable = [
        'title', 'content', 'user_id', 'country', 'city'
    ];
}
