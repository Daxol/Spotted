<?php

namespace App\Http\Controllers\Advertisement;

use App\Advertisement;
use App\AdvertisementComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdvertisementCommentController extends Controller
{


    public function store(Request $request, $advertisement_id)
    {
        $this->validate($request, ['content' => 'required|min:3|max:200']);
        $data = ['advertisement_id' => $advertisement_id, 'content' => \request('content')];
        return AdvertisementComment::createComment($data);
    }

    public function index($advertisement_id)
    {
        try {
            return AdvertisementComment::getComments($advertisement_id);
        } catch (\Exception $exception) {
            return response()->json(["error" => "error". $exception->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
}
