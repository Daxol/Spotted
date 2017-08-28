<?php

namespace App\Http\Controllers\User;

use App\AuthClient;
use App\GoogleMap\GoogleMap;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = AuthClient::getUser();

            if (!empty($request['password'])) {
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
