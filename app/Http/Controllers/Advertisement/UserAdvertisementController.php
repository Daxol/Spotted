<?php

namespace App\Http\Controllers\Advertisement;

use App\Advertisement;
use App\Transformers\AdvertisementTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Fractal\Fractal;

class UserAdvertisementController extends Controller
{
    public function index($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $advertisements = $user->advertisements;

            $fract = Fractal::create();

           $fract->collection($advertisements, AdvertisementTransformer::class);

            return $fract = $fract->toArray()['data'];
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }

    }
}
