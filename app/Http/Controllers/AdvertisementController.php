<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\AuthClient;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);
        $data = [
            'title' => \request('title'),
            'content' => \request('content'),
            'country' => \request('country'),
            'city' => \request('city'),
            'user_id' => AuthClient::getUserId(),
        ];

        return Advertisement::store($data);
    }

    public function index()
    {
        return Advertisement::all();
    }

    public function show($id)
    {
        try {
            $advertisement = Advertisement::whereId($id)->firstOrFail();
            return response()->json(['advertisement' => $advertisement], 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => 'no result'], 400);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'city' => 'required',
                'country' => 'required'
            ]);

            $data = [
                'title' => \request('title'),
                'content' => \request('content'),
                'country' => \request('country'),
                'city' => \request('city'),
                'user_id' => AuthClient::getUserId(),
            ];

            return Advertisement::updateAdvertisement($id, $data);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }


    }

    public function destroy($id)
    {
        Advertisement::deactiveAdvertisement($id);
    }
}
