<?php

namespace App\Http\Controllers;

use App\UserComplaint;
use Illuminate\Http\Request;

class UserComplaintController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $this->validate($request, ['content' => 'required|max:200|min:3', 'type' => 'required|min:1|max:1']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

        return UserComplaint::createComplaint($id, \request(['content', 'type']));
    }
}
