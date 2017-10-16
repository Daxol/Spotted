<?php

namespace App\Http\Controllers\User;

use App\AuthClient;
use App\GoogleMap\GoogleMap;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class UserController extends Controller
{


    public function show($id)
    {

        if ($id === "me") {
            $user = AuthClient::getUser();
        } else {
            $user = User::findOrFail($id);

        }

        $fract = Fractal::create();

        $respo = $fract->item($user, UserTransformer::class);
        return $respo->toArray()['data'];


    }

    public function update(Request $request, $id)
    {
        try {
            $user = AuthClient::getUser();

            if (!empty($request['password'])) {
                $this->validate($request, [
                    'password' => 'required|confirmed|min:6'
                ]);

                return $user->changePassword($request['password']);
            }

            $this->validate($request, [
                'name' => 'required|min:2|max:30',
                'surname' => 'required|min:2|max:30',
                'birthday' => 'required|date'
            ]);
            $user->updatePersonDetails(request()->all());
            return response()->json(['msg' => 'user details updated', 'status' => 'ok']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }
}
