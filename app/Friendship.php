<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['receiver_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getFriendship($id)
    {
        try {
            $friendship = Friendship::findOrFail($id);
            return $friendship;
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Friendship do not exist']);
        }
    }

    public static function createFriendship($id)
    {
        try {
            User::findOrFail($id);
            $senderUser = AuthClient::getUser();
            $checkFriendship = Friendship::where(['user_id' => $id, 'receiver_user_id' => AuthClient::getUserId()])
                ->orWhere(['receiver_user_id' => $id, 'user_id' => AuthClient::getUserId()])
                ->get();

            if (count($checkFriendship) > 0) {
                return response()->json(['error' => 'friendship is already created', 'status' => 401]);
            }
            $friendship = new Friendship(['receiver_user_id' => $id]);
            $senderUser->friendships()->save($friendship);

            return response()->json(['msg' => 'friendship request is now pending', 'status' => 'ok']);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public static function changeFriendshipStatus($id, $status)
    {
        try {
            $friendship = Friendship::findOrFail($id);

            if ($friendship->user_id === AuthClient::getUserId()) {

                $friendship->status_sender = $status;
                $friendship->save();
            } else if ($friendship->receiver_user_id === AuthClient::getUserId()) {

                $friendship->status_receiver = $status;
                $friendship->save();

            } else {
                return response()->json(['error' => 'not authorized', 'status' => 401]);
            }
            return response()->json(['msg' => 'friendship status changed', 'status' => 'ok']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
