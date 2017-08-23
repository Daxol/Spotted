<?php

namespace App\Http\Controllers;

use App\AuthClient;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function test()
    {
        $user = AuthClient::getUser();
        return $user->getComplaintFromMe();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2|max:30',
                'surname' => 'required|min:2|max:30',
                'birthday' => 'required'
            ]);
            $user = AuthClient::getUser();
            $user->updatePersonDetails(request()->all());
            return response()->json(['msg' => 'user details updated', 'status' => 'ok']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }
}
