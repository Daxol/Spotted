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
        if (request()->has('country')) {
            $advertisements = Advertisement::whereCountry(\request('country'));
        } else {
            $advertisements = Advertisement::whereCountry('Poland');
        }

        if (request()->has('city')) {
            if (request()->has('distance')) {
                $advertisements->city(request('city'), \request('distance'));
            } else {
                $advertisements->city(request('city'));
            }
        }

        if (request()->has('keywords')) {
            $advertisements->keywords(request('keywords'));
        }

        if (request()->has('category')) {
            $advertisements->category(request('category'));
        }

        if (request()->has('paginate')) {
            return $advertisements->paginate(\request('paginate'));
        } else {
            return $advertisements->paginate(20);
        }
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
