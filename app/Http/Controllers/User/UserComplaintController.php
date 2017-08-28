<?php

namespace App\Http\Controllers\User;

use App\AuthClient;
use App\Http\Controllers\Controller;
use App\User;
use App\UserComplaint;
use Illuminate\Http\Request;

class UserComplaintController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $this->validate($request, ['content' => 'required|max:200|min:3', 'type' => 'required|min:1|max:1']);
            return UserComplaint::createComplaint($id, \request(['content', 'type']));

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

    public function show($id_user, $id_complaint)
    {
        try {
            if (AuthClient::getUser()->isAdmin()) {
                return UserComplaint::findOrFail($id_complaint);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

    public function index($id_user)
    {
        try {
            if (AuthClient::getUser()->isAdmin()) {

                $user = User::findOrFail($id_user);

                return $user->getComplaintOnMe()->get();
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
