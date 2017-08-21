<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementComment extends Model
{

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createComment($data)
    {
        try {
            $advertisement = Advertisement::whereId($data['advertisement_id'])->firstOrFail();
            if ($advertisement == null) {
                return response()->json(['error' => 'could not create comment, no advertisement'], 401);
            }
            $advertisementComment = new AdvertisementComment();
            $advertisementComment->content = $data['content'];
            $advertisementComment->user_id = AuthClient::getUserId();
            $advertisement->advertisementComment()->save($advertisementComment);
            return response()->json(['msg' => 'comment has been created', 'status' => 200], 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => 'No query results for model with id ' . $data['advertisement_id']], 500);
        }


    }

    protected $fillable = ['user_id', 'content', 'advertisement_id'];
}
