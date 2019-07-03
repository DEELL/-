<?php

namespace App\Http\Middleware;
use  Illuminate\Support\Facades\Redis;

use Closure;

class CheckSession
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
              $key='token'.$id;//拼接成redis键
              $redes_token=Redis::get($key);//取出redis中的token
              $session_token=session('token');//取出session中的token
              if($redes_token==null){//如果redis是空的
                  echo "<script>alert('已被强制下线');location.href='/app/login'</script>>";die;
              }
            if($redes_token!=$session_token){//session中的token和redis中的token不一致
                echo "<script>alert('ip已在其他地方登录');location.href='/app/login'</script>>";die;
            }
        }else{
            echo "非法操作";
            header('Refresh:2;url='."/app/login");die;
        }
        return $next($request);
    }
}
