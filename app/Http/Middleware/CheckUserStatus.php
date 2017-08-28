<?php

namespace App\Http\Middleware;

use App\AuthClient;
use Closure;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (AuthClient::getUser()->account_status === 0) {
            return response()->json(['error' => 'account blocked!'], 401);
        }

        return $next($request);
    }
}
