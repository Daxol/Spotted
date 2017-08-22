<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @param $status
     * account status
     * 1 - active (default)
     * 0 - blocked
     */
    public function changeAccountBlockStatus($status)
    {
        $this->account_status = $status;
        $this->save();
    }

    /**
     * @param $rank
     * user rank
     * 0 - normal (default)
     * 1 - donator
     * 2 - premium
     * 8 - admin
     * 9 - head admin
     *
     */
    public function changeUserRank($rank)
    {
        $this->user_rank = $rank;
        $this->save();
    }

    public function updatePersonDetails($data)
    {
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->birthday = $data['birthday'];
        $this->save();
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function advertisementComments()
    {
        return $this->hasMany(AdvertisementComment::class);
    }

    public function sendMessages()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    public function messageThreads()
    {
        return MessageThread::where('from_user_id', AuthClient::getUserId())
            ->orWhere('to_user_id', AuthClient::getUserId())
            ->get();
    }

    protected $fillable = [
        'name', 'surname', 'birthday', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
