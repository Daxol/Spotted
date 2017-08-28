<?php

namespace App\Http\Controllers;

use App\AuthClient;
use App\BugReport;
use Illuminate\Http\Request;

class BugReportController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request, ['content' => 'required|min:1|max:200']);
            BugReport::create(['content' => \request('content')]);

            return response()->json(['msg' => 'report added', 'status' => 'ok']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }


    public function show($id)
    {
        try {
            if (AuthClient::getUser()->isAdmin()) {
                return BugReport::findOrFail($id);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

    public function index($id_user)
    {
        try {
            if (AuthClient::getUser()->isAdmin()) {
                return BugReport::whereStatus(1)->get();
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
