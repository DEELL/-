<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class FreshTooken
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
        $id=session('u_id');//从session中取出id
        if($id){
            $key='token'.$id;//生成key
            Redis::expire($key,20); //每次刷新 redis时间变成20秒  如果不刷新 redi会过期
        }
        return $next($request);
    }
}
