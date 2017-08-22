<?php

namespace App\Http\Controllers;

use App\AuthClient;
use App\MessageThread;
use Illuminate\Http\Request;

class MessageThreadController extends Controller
{
    public function store(Request $request, $to_user_id)
    {
        return MessageThread::openThread($to_user_id);
    }

    public function index($user_id)
    {
        $user = AuthClient::getUser();
        return $user->messageThreads();
    }
}
