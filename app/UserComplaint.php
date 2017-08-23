<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComplaint extends Model
{
    public static function createComplaint($id, $data)
    {
        try {

            $receiverUser = User::findOrFail($id);

            $complaint = new UserComplaint(
                [
                    'declarant_id' => AuthClient::getUserId(),
                    'receiver_id' => $id,
                    'content' => $data['content'],
                    'type' => $data['type']
                ]);
            $complaint->save();

            return response()->json(['msg' => 'complaint created', 'status' => 'ok']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    protected $fillable = ['content', 'type', 'declarant_id', 'receiver_id'];
}
