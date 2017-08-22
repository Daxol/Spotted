<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    public static function saveMessage($content, $thread_id)
    {
        try {
            $messageThread = MessageThread::findOrFail($thread_id);
            $message = new Message(['content' => $content, 'user_id' => AuthClient::getUserId()]);
            $messageThread->messages()->save($message);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
        return response()->json(['msg' => 'message saved']);
    }


    public static function getMessagesForThread($thread_id)
    {
        try {

            $messageThread = MessageThread::findOrFail($thread_id);

            if ($messageThread->from_user_id != AuthClient::getUserId() && $messageThread->to_user_id != AuthClient::getUserId()) {
                return response()->json(['error' => 'not Authorized'], 401);
            }
            return $messageThread->messages()->get();
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }


    public function senderUser()
    {
        return $this->belongsTo(User::class, 'id', 'from_user_id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'id', 'to_user_id');
    }

    public function messageThread()
    {
        return $this->belongsTo(MessageThread::class);
    }

    protected $fillable = ['content', 'user_id', 'thread_id'];
}
