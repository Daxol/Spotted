<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageThread;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, $thread_id)
    {
        $this->validate($request,
            ['content' => 'required|min:1|max:255']);

        return Message::saveMessage(request('content'), $thread_id);
    }

    public function index($thread_id)
    {
        return Message::getMessagesForThread($thread_id);
    }


}
