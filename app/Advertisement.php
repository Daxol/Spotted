<?php

namespace App;

use App\helpers\AdvertisementStatus;
use Carbon\Carbon;
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
            if (!self::checkIfUserCanAddNewAdvertisementNow()) {
                return response()->json(['error' => 'spam block, wait or donate'], 403);
            }
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

    public static function checkIfUserCanAddNewAdvertisementNow()
    {
        $user = AuthClient::getUser();
        $advertisments = $user->advertisements()
            ->where('created_at', '>', Carbon::now()
                ->subMinutes(3)
                ->toDateTimeString())->get();
        if (count($advertisments) > 0) {
            return false;
        }
        $advertisments = $user->advertisements()
            ->where('created_at', '>', Carbon::now()->subDays(30)
                ->toDateTimeString())->get();
        if (count($advertisments) >= 10 && AuthClient::getUser()->rank == 0) {
            return false;
        }
        return true;
    }

    protected $fillable = [
        'title', 'content', 'user_id', 'place_id', 'city_pl', 'city_en', 'country'
    ];
}
