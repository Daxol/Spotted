<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 23.08.17
 * Time: 12:51
 */

namespace App\helpers;

use App\User;
use App\UserComplaint;

trait UserComplaintTrait
{
    public function getComplaintOnMe()
    {
        return UserComplaint::where('receiver_id', $this->id);
    }

    public function getComplaintFromMe()
    {
        return UserComplaint::where('declarant_id', $this->id);
    }
}