<?php

namespace App\Http\Controllers\Advertisement;

use App\AdvertisementComplaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdvertisementComplaintController extends Controller
{
    public function store(Request $request, $advertisement_id)
    {
        try {
            $this->validate($request, ['content' => 'required|min:3|max:200', 'type' => 'required|min:1|max:1']);
            return AdvertisementComplaint::createComplaint(\request(['type', 'content']), $advertisement_id);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
