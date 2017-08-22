<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model
{

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public static function openThread($to_user_id)
    {

        try {
            $receiverUser = User::findOrFail($to_user_id);
            MessageThread::create(['from_user_id' => AuthClient::getUserId(), 'to_user_id' => $to_user_id]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
        return response()->json(['msg' => 'thread created']);

    }

    protected $fillable = [
        'from_user_id', 'to_user_id'
    ];
}
