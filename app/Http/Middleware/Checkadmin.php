<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Checkadmin
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
        echo "这里是普通管理员！\n";
        $data = Auth::user();
        //echo $data;
        if($data['position_id'] != 2 && $data['position_id'] != 3 && $data['position_id'] != 4 )
        {
            return abort(403,'抱歉，你没有权限访问！');
        }
        if($data['state_id'] != 1 && $data['state_id'] != 2)
        {
            return abort(403,'你的账号已禁用！');
        }
        return $next($request);
    }
}
