<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserComplaint extends Model
{
    public static function createComplaint($id, $data)
    {
        try {

            $receiverUser = User::findOrFail($id);
            if (!self::checkIfUserCanAddNewComplaint()) {
                return response()->json(['error' => 'wait to add new complaint'],403);
            }
            if ($data['type'] < 0 || $data['type'] > 4) {
                return response()->json(['error' => 'wrong type, try again'], 403);
            }
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

    protected static function checkIfUserCanAddNewComplaint()
    {
        $user = AuthClient::getUser();
        $advertisments = $user->getComplaintFromMe()
            ->where('created_at', '>', Carbon::now()
                ->subDays(1)
                ->toDateTimeString())->get();

        if (count($advertisments) >= 1 && $user->rank != 9) {
            return false;
        }
        return true;
    }

    protected $fillable = ['content', 'type', 'declarant_id', 'receiver_id'];
}
