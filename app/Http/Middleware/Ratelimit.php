<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class Ratelimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        $ipAddres=$request->ip();

   $key="user_attempts:{$ipAddres}";

   $attempts=(int)Redis::get($key)??0;

    if($attempts>=5){
         return response()->json(['message'=>'many request'

         ],429);
    }

    Redis::set($key,++$attempts);
    Redis::expire($key,3600);

        return $next($request);
    }
}
