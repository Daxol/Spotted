<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Advertisement extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
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



    protected $fillable = [
        'title', 'content', 'user_id','country','city'
    ];
}
