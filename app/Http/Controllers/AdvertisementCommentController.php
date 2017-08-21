<?php

namespace App\Http\Controllers;

use App\AdvertisementComment;
use Illuminate\Http\Request;

class AdvertisementCommentController extends Controller
{


    public function store(Request $request, $advertisement_id)
    {
        $this->validate($request, ['content' => 'required|min:3']);
        $data = ['advertisement_id' => $advertisement_id, 'content' => \request('content')];
       return AdvertisementComment::createComment($data);
    }


    public function destroy($id)
    {
        //
    }
}
