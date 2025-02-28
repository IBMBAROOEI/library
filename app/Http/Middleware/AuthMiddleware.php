<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
