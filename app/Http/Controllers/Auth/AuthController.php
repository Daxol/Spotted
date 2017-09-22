<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function signIn(Request $request)
    {


        try {

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['msg' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $exception) {
            return response()->json(['msg' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);

    }


    public function refresh()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return $this->response()->json(['msg' => 'Token is invalid'], 401);

        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        }
        return response()->json(['token' => $refreshedToken]);
    }
}
