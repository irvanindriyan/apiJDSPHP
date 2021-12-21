<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Fungsi;
use JWTAuth;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(
                Fungsi::resError('User not found.')
            , 422);
        }

        if ($user->role_id == 1) {
            return $next($request);
        } else {
            return response()->json(
                Fungsi::resError('Request must be Admin')
            , 422);
        }
    }
}
