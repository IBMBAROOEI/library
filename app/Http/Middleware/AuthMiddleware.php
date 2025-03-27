<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // احراز هویت کاربر با توکن
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {


                return response()->json(['message' => 'کاربر نامعتبر'], 401);
            }

            // ادامه درخواست
            return $next($request);
        } catch (\Throwable $e) {
            // مدیریت خطاها
            return response()->json(['message' => 'خطا در احراز هویت: ' . $e->getMessage()], 401);
        }
    }
}
