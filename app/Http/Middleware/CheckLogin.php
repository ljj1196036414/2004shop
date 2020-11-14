<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $uid=session('user.uid');
       // dd($uid);
        if(empty($uid)){
            if(isset($_SERVER['HTTP_X_REQUESTD_WITH'])&&$_SERVER['HTTP_X_REQUESTD_WITH']=='XMLHttpRequest') {
                $response=[
                    'erron'==400003,
                    'msg'=>"请先登录"
                ];
                die(json_encode($response));
            }
            return redirect('/user/login');
        }
        return $next($request);
    }
}
