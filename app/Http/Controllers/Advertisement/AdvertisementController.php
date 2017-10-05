<?php

namespace App\Http\Controllers\Advertisement;

use App\Advertisement;
use App\AuthClient;
use App\helpers\Paginator;
use App\Transformers\AdvertisementTransformer;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;
use App\Http\Controllers\Controller;


class AdvertisementController extends Controller
{

    public function store(Request $request)
    {
//        error_log(print_r($request, TRUE));


        try {


            $this->validate($request, [
                'title' => 'required|max:40',
                'content' => 'required|max:200',
                'place_id' => 'required|max:200',
                'country' => 'required|max:2'
            ]);

            $data = [
                'title' => \request('title'),
                'content' => \request('content'),
                'country' => \request('country'),
                'place_id' => \request('place_id'),
                'user_id' => AuthClient::getUserId(),
            ];
            return Advertisement::store($data);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

    public function index()
    {
        if (request()->has('country')) {
            $advertisements = Advertisement::whereCountry(\request('country'));
        } else {
            $advertisements = Advertisement::whereCountry('pl');
        }

        if (request()->has('date_from')) {
            $advertisements->date_from(request('date_from'));
        }
        if (request()->has('date_until')) {
            $advertisements->date_until(request('date_until'));
        }

        if (request()->has('city')) {
            $advertisements->city(request('city'));
        }

        if (request()->has('place_id')) {
            $advertisements->place(request('place_id'));
        }

        if (request()->has('keywords')) {
            $advertisements->keywords(request('keywords'));
        }
        if (request()->has('status')) {
            $advertisements->status(request('status'));
        } else {
            $advertisements->where('status', '>=', 1);
        }


        if (request()->has('category')) {
            $advertisements->category(request('category'));
        }
        $fract = Fractal::create();

        $fract = $fract->collection($advertisements->get(), AdvertisementTransformer::class);
        if (request()->has('paginate')) {

            return Paginator::paginateCollection(collect($fract->toArray()['data']), \request('paginate'));
        } else {

            return Paginator::paginateCollection(collect($fract->toArray()['data']), 15);
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
                'title' => 'required|max:40',
                'content' => 'required|max:200',
            ]);

            $data = [
                'title' => \request('title'),
                'content' => \request('content'),
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
