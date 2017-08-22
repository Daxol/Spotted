<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
